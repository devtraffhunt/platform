
var csrf_token = $('meta[name="csrf-token"]').attr('content')
var chart = {
  height: 350,
  type: 'area',
  toolbar: {
    show: false
  },
  zoom: {
    type: 'x',
    enabled: false,
    autoScaleYaxis: true
  },
}
var dataLabels = {
  enabled: false
}
var stroke = {
  curve: 'smooth',
  width: 2
}
var markers = {
  size: 3,
  strokeWidth: 3,
  hover: {
    size: 4,
    sizeOffset: 2
  }
}
var yaxis = {
  low: 0,
  offsetX: 0,
  offsetY: 0,
  show: true,
  labels: {
    low: 0,
    offsetX: 0,
    show: true,
  },
  axisBorder: {
    low: 0,
    offsetX: 0,
    show: true,
  },
}
var grid = {
  row: {
    colors: ['transparent', 'transparent'], opacity: .2
  },
  borderColor: 'rgba(0,0,0,0.05)'
}
var colors = ['#556ee6', '#f1b44c']
var fill = {
  type: 'gradient',
  gradient: {
    shadeIntensity: 1,
    inverseColors: false,
    opacityFrom: 0.45,
    opacityTo: 0.05,
    stops: [20, 100, 100, 100]
  }
}
var legend = {
  show: false,
}
var tooltip = {
  x: {
    format: 'dd.MM.yy HH:mm'
  },
}

var axisBorder = {
  show: true, 
  color: 'rgba(0,0,0,0.05)'
}
var axisTicks = {
  show: true, 
  color: 'rgba(0,0,0,0.05)'
}

function statUpdate(id, that) {
  $.post('/admin/chart', { _token: csrf_token, id }).then(data => {
    updateSummary(data);
    updateActiveTab(that);
    renderCharts(data, id); // передаём id

    updatePaymentTable(id);
  }).fail(err => {
    noty('error', JSON.parse(err.responseText).message);
  });
}

function updatePaymentTable(id) {
  $.post('/admin/payment-stats', { _token: csrf_token, id }).then(data => {
    $('#payment-stats-table tbody').html(''); // очищаем старое содержимое

    data.data.forEach(item => {
      const totalAmountFormatted = formatCurrency(item.total_amount);

      const status = item.status === 1
        ? '<span class="badge badge-pill badge-soft-success font-size-11">Активен</span>'
        : '<span class="badge badge-pill badge-soft-danger font-size-11">Неактивен</span>';

      const row = `
        <tr>
          <td>${item.ps_system_id}</td>
          <td>${item.name}</td>
          <td>${totalAmountFormatted}</td>
          <td>${item.cr}%</td>
          <td>${item.successful_transactions}</td>
          <td>${item.total_transactions}</td>
          <td>${status}</td>
          <td>${item.active_methods}</td>
        </tr>
      `;

      $('#payment-stats-table tbody').append(row);
    });
  }).fail(err => {
    let message = 'Ошибка при получении данных!';
    if (err.responseText) {
      try {
        message = JSON.parse(err.responseText).message;
      } catch (e) {}
    }
    noty('error', message);
  });
}




function formatCurrency(value) {
  return parseFloat(value).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ' ') + ' UZS';
}

function updateSummary(data) {
  $('#deposits_amount').html(formatCurrency(data.deps_n));
  $('#deposits_count').html(data.deps_count_n);
  $('#reg_count').html(data.regs_count_n);
}

function updateActiveTab(element) {
  $('.stat-pills .nav-link').removeClass('active');
  $(element).addClass('active');
}

function renderCharts(data, id) {
  $('#chart1, #chart2').remove();
  $('.chartAdmin1').append('<div id="chart1" class="apex-charts" dir="ltr"></div>');
  $('.chartAdmin2').append('<div id="chart2" class="apex-charts" dir="ltr"></div>');

  const formatters = {
    1: val => dayjs(val).format('HH:mm'),
    2: val => dayjs(val).format('DD MMM'),
    3: val => dayjs(val).format('DD MMM'),
    4: val => dayjs(val).format('MMM')
  };

  const tooltipFormat = {
    1: 'HH:mm',
    2: 'dd MMM',
    3: 'dd MMM',
    4: 'MMM'
  }[id];

  const xaxisBase = {
    type: 'datetime',
    categories: data.labels,
    tickPlacement: 'on',
    labels: {
      formatter: formatters[id],
      rotate: -45
    },
    
    ...axisOptions()
  };

  const chart1 = new ApexCharts(document.querySelector("#chart1"), {
    ...commonChartOptions({ tooltipFormat }),
    series: [{ name: 'Сумма', data: data.deps }],
    xaxis: xaxisBase
  });
  chart1.render();

  const chart2 = new ApexCharts(document.querySelector("#chart2"), {
    ...commonChartOptions({
      formatY: val => val.toFixed(0),
      formatTooltip: val => val.toFixed(0),
      tooltipFormat
    }),
    series: [
      { name: 'Регистрации', data: data.regs },
      { name: 'Уникальные регистрации', data: data.regs_uniqe },
      { name: 'Депозиты', data: data.dep_counts },
      { name: 'Уникальные депозиты', data: data.dep_unique_counts }
    ],
    colors: ['#556ee6', '#f1b44c', '#00b894', '#90b800'],
    xaxis: xaxisBase
  });
  chart2.render();
}


function commonChartOptions({
  formatY = val => formatYAxis(val),
  formatTooltip = val => val.toFixed(2),
  tooltipFormat = 'dd MMM'
} = {}) {
  return {
    markers, yaxis, grid, colors, fill, legend,
    tooltip: {
      x: {
        format: tooltipFormat
      },
      y: {
        formatter: formatTooltip
      }
    },
    yaxis: {
      labels: {
        formatter: formatY
      }
    },
    chart, dataLabels, stroke
  };
}




function formatYAxis(val) {
  if (val >= 1_000_000_000) return (val / 1_000_000_000).toFixed(1) + 'B';
  if (val >= 1_000_000)     return (val / 1_000_000).toFixed(1) + 'M';
  if (val >= 1_000)         return (val / 1_000).toFixed(0) + 'K';
  return val.toFixed(0);
}


function axisOptions() {
  return {
    axisBorder, axisTicks
  };
}


function noty(type, msg) {
  alert(msg)
}

function saveUser(id) {
  $.post('/admin/saveUser',{_token: csrf_token, id, balance: $('#balance').val(), demo_balance: 0, admin: $('#admin').val()}).then(e=>{
    noty('success', 'Успешно')
    $('#balance_2').val($('#balance').val())
  }).fail(e=>{
    noty('error', JSON.parse(e.responseText).message)
  });
}

function changeBan(id, type) {
  $.post('/admin/changeBan',{_token: csrf_token, id}).then(e=>{
    location.href = ''
  }).fail(e=>{
    noty('error', JSON.parse(e.responseText).message)
  });
}

function resetPassword(id) {
  $.post('/admin/resetPassword', {_token: csrf_token, id})
    .then(e => {
      alert('Новый пароль: ' + e.new_password); // показываем новый пароль в alert
    })
    .fail(e => {
      noty('error', JSON.parse(e.responseText).mess); // у тебя было .message, но на сервере ты возвращаешь 'mess'
    });
}


function changeFrozen(id) {
  $.post('/admin/changeFrozen',{_token: csrf_token, id}).then(e=>{
    location.href = ''
  }).fail(e=>{
    noty('error', JSON.parse(e.responseText).message)
  });
}


function changePay(id) {
  $.post('/admin/changePay',{_token: csrf_token, id}).then(e=>{
    location.href = ''
  }).fail(e=>{
    noty('error', JSON.parse(e.responseText).message)
  });
}

function changeWithdraw(id, status) {
  $.post('/admin/changeWithdraw',{_token: csrf_token, id, status}).then(e=>{
    if(e.success == false) return noty('error', e.mess);
    location.href = ''
  }).fail(e=>{
    noty('error', JSON.parse(e.responseText).message)
  });
} 

function saveSystemWithdraw(id){
  name = $('#systemWithdraw_'+id+' .systemWithdraw_name').val()
  min_sum = $('#systemWithdraw_'+id+' .systemWithdraw_min_sum').val()
  comm_percent = $('#systemWithdraw_'+id+' .systemWithdraw_comm_percent').val()
  comm_rub = $('#systemWithdraw_'+id+' .systemWithdraw_comm_rub').val()
  img = $('#systemWithdraw_'+id+' .systemWithdraw_img').val()
  off = $('#systemWithdraw_'+id+' .systemWithdraw_off').val()
  color = $('#systemWithdraw_'+id+' .systemWithdraw_color').val()

  $.post('/admin/saveSystemWithdraw',{_token: csrf_token, id, name, min_sum, comm_percent, comm_rub, img, off, color}).then(e=>{
    noty('success', 'Успешно')
  }).fail(e=>{
    noty('error', JSON.parse(e.responseText).message)
  });
}

function addSystemWithdraw(){
  name = $('#name').val()
  min_sum = $('#min_sum').val()
  comm_percent = $('#comm_percent').val()
  img = $('#img').val()
  comm_rub = $('#comm_rub').val()
  color = $('#color').val()

  $.post('/admin/addSystemWithdraw',{_token: csrf_token, name, min_sum, comm_percent, img, comm_rub, color}).then(e=>{
    location.href = ''
  }).fail(e=>{
    noty('error', JSON.parse(e.responseText).message)
  });
}

function deleteSystemWithdraw(id) {
  $.post('/admin/deleteSystemWithdraw',{_token: csrf_token, id}).then(e=>{
    location.href = ''
  }).fail(e=>{
    noty('error', JSON.parse(e.responseText).message)
  });
}


function saveSystemDeposit(id){
  name = $('#systemDeposit_'+id+' .systemDeposit_name').val()
  min_sum = $('#systemDeposit_'+id+' .systemDeposit_min_sum').val()
  comm_percent = $('#systemDeposit_'+id+' .systemDeposit_comm_percent').val()
  img = $('#systemDeposit_'+id+' .systemDeposit_img').val()
  ps = $('#systemDeposit_'+id+' .systemDeposit_ps').val()
  number_ps = $('#systemDeposit_'+id+' .systemDeposit_number_ps').val()
  off = $('#systemDeposit_'+id+' .systemDeposit_off').val()
  color = $('#systemDeposit_'+id+' .systemDeposit_color').val()
  sort = $('#systemDeposit_'+id+' .systemDeposit_sort').val()

  $.post('/admin/saveSystemDeposit',{_token: csrf_token, id, name, min_sum, comm_percent, img, ps, number_ps, off, color, sort}).then(e=>{
    noty('success', 'Успешно')
  }).fail(e=>{
    noty('error', JSON.parse(e.responseText).message)
  });
}

function addSystemDeposit(){
  name = $('#name').val()
  min_sum = $('#min_sum').val()
  comm_percent = $('#comm_percent').val()
  img = $('#img').val()
  ps = $('#ps').val()
  number_ps = $('#number_ps').val()
  color = $('#color').val()

  $.post('/admin/addSystemDeposit',{_token: csrf_token, name, min_sum, comm_percent, img, ps, number_ps, color}).then(e=>{
    location.href = ''
  }).fail(e=>{
    noty('error', JSON.parse(e.responseText).message)
  });
}

function deleteSystemDeposit(id) {
  $.post('/admin/deleteSystemDeposit',{_token: csrf_token, id}).then(e=>{
    location.href = ''
  }).fail(e=>{
    noty('error', JSON.parse(e.responseText).message)
  });
} 


function createPromo() {
  $.post('/admin/createPromo',{_token: csrf_token, name: $('#name_promo').val(), sum: $("#sum_promo").val(), active: $("#active_promo").val()}).then(e=>{
    location.href = ''
  }).fail(e=>{
    noty('error', JSON.parse(e.responseText).message)
  });
}

function deletePromo(id){
  $.post('/admin/deletePromo',{_token: csrf_token, id}).then(e=>{
    location.href = ''
  }).fail(e=>{
    noty('error', JSON.parse(e.responseText).message)
  });
}

function createDepPromo() {
  $.post('/admin/createDepPromo',{_token: csrf_token, name: $('#name_promo').val(), percent: $("#percent_promo").val(), active: $("#active_promo").val()}).then(e=>{
    location.href = ''
  }).fail(e=>{
    noty('error', JSON.parse(e.responseText).message)
  });
}

function deleteDepPromo(id){
  $.post('/admin/deleteDepPromo',{_token: csrf_token, id}).then(e=>{
    location.href = ''
  }).fail(e=>{
    noty('error', JSON.parse(e.responseText).message)
  });
}

function saveSetting(type){
  param = {_token: csrf_token, type}

  if(type == 1){
    param = {_token: csrf_token, type,
      name: $('#name').val(),
      support_contact: $('#support_contact').val(),
      status: $('#status_site').val(),
    };
  }

  if (type == 2) {
    // Payou
    param.payou_merchant_id = $('#payou_merchant_id').val();
    param.payou_secret = $('#payou_secret').val();
}

if (type == 3) {
    // Pear2Pay
    param.pear2pay_api = $('#pear2pay_api').val();
    param.pear2pay_secret = $('#pear2pay_secret').val();
}

if (type == 4) {
    // Kassify
    param.kassify_merchant_id = $('#kassify_merchant_id').val();
    param.kassify_secret = $('#kassify_secret').val();
}

if (type == 5) {
    // PayHub24
    param.payhub24_public_key = $('#payhub24_public_key').val();
    param.payhub24_private_key = $('#payhub24_private_key').val();
}
  
  
  $.post('/admin/saveSetting',param).then(e=>{
    noty('success', 'Успешно')
  }).fail(e=>{
    noty('error', JSON.parse(e.responseText).message)
  });
}

function resetBank(type){
  $.post('/admin/resetBank',{_token: csrf_token, type}).then(e=>{
    if(e.success){
      noty('success', e.mess)
      $('#'+type+'_bank').val(200)
      $('#'+type+'_profit').val(0)
    }else{
      noty('error', e.mess)
    }

  });
}

function placesTourniers() {
        places = $('#places_t').val();
        places = Number(places)
        $('#places_input_t').html('')
        for (var i = 1; i <= places; i++) {
          $('#places_input_t').append('<div class="col-lg-3 mb-3">\
                <label>Приз за '+i+' место</label>\
                <input type="" id="place_'+i+'_t" value="100" class="form-control" name="">\
              </div>\
              ')
        }
}



function createTournier(){
  name = $('#name_t').val();
  places = $('#places_t').val();
  places = Number(places)

  prizes = []

  for (var i = 1; i <= places; i++) {
    prizes.push(Number($('#place_'+i+'_t').val()))
  }

  start = $('#start_t').val();
  end = $('#end_t').val();
  game_id = $('#game_t').val();
  desc = $('#desc_t').val();

  $.post('/admin/createTournier',{_token: csrf_token, name, places, prizes, start, end, game_id, desc}).then(e=>{
    if(e.success){
      location.href = ''
    }else{
      notification('error', e.mess)
    }

  }); 
}

// function systemUP(system_id, sort){
//   if (sort == 1){
//     return true;
//   }

//   upper_element =  $('.systemSort_'+sort)
//   downer_element =  $('.systemSort_'+(sort - 1))
// }