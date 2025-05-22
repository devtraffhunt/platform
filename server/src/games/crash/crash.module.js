const Redis = require('ioredis');
const requestify = require('requestify');
const { query } = require('../../utils/db');

module.exports = (io) => {

  const redis = new Redis(process.env.REDIS_URL);
  const domain = process.env.DOMAIN;

  usersOnline = [];
gamesOnline = [[],[],[],[],[],[],[],[],[]];

io.on('connection', async (socket) => {


    socket.on('getUsersOnline', function() {
        socket.emit('usersOnline', usersOnline.length);
    });

    socket.on('getGamesOnline', function() {
        //sendGamesOnline(gamesOnline)
        socket.emit('gamesOnline', JSON.stringify(gamesOnline));

    });

    socket.on('subscribe',function(room){
        
        try{
            room_split = room.split('_')
            if (room_split[0] == 'roomUser'){
                
                if(!usersOnline.includes(room_split[1])){
                    usersOnline.push(room_split[1])
                }

                io.sockets.emit('usersOnline', usersOnline.length);

                console.log(usersOnline)
                console.log('[socket]','join user with id ',room_split[1])
            }

            if (room_split[0] == 'roomGame'){
                clearUserGame(room_split[2])
                
                if(!gamesOnline[room_split[1]].includes(room_split[2])){
                    gamesOnline[room_split[1]].push(room_split[2])
                }

                // sendGamesOnline(gamesOnline)
                io.sockets.emit('gamesOnline', JSON.stringify(gamesOnline));

                console.log(gamesOnline)
                console.log('[socket]','join game', room_split[1], 'with id ',room_split[2])
            }


            console.log('[socket]','join room :',room)
            socket.join(room);
            socket.to(room).emit('user joined', socket.id);
        }catch(e){
            console.log('[error]','join room :',e);
            socket.emit('error','couldnt perform requested action');
        }
    })

    socket.on('disconnecting', function(){
        console.log("disconnecting.. ", socket.id)
        notifyFriendOfDisconnect(socket)
    });

    function notifyFriendOfDisconnect(socket){
        var rooms = Object.keys(socket.rooms);
        rooms.forEach(function(room){
            room_split = room.split('_')
            if (room_split[0] == 'roomGame'){
                
                const index = gamesOnline[room_split[1]].indexOf(room_split[2]);
                if (index > -1) { // only splice array when item is found
                  gamesOnline[room_split[1]].splice(index, 1); // 2nd parameter means remove one item only
              }

                // sendGamesOnline(gamesOnline)
                io.sockets.emit('gamesOnline', JSON.stringify(gamesOnline));
                console.log(gamesOnline)
                console.log('[socket]','left game', room_split[1], ' with id ',room_split[2])
            }

            if (room_split[0] == 'roomUser'){
                
                const index = usersOnline.indexOf(room_split[1]);
                if (index > -1) { // only splice array when item is found
                  usersOnline.splice(index, 1); // 2nd parameter means remove one item only
              }

              io.sockets.emit('usersOnline', usersOnline.length);
              console.log(usersOnline)
              console.log('[socket]','left user with id ',room_split[1])
          }

          
          socket.to(room).emit('connection left', socket.id + ' has left');
      });
    }

    
});

function clearUserGame(user_id){
    let i = 0;
    while (i < 8) {
        const index = gamesOnline[i].indexOf(user_id);
        if (index > -1) { // only splice array when item is found
            gamesOnline[i].splice(index, 1); // 2nd parameter means remove one item only
        }
        
        i++;
    }
}

io.on('connection', function(socket) {
    socket.on('giveCrash', async function(msg) {
        if(statusCrashGo == 1){
            let gameId = parseInt(msg.gameId);
            
            var gameCrash = await query('SELECT * FROM crash WHERE id = ?', [gameId])

            crash_userId = gameCrash[0].user_id
            crash_userBet = gameCrash[0].bet

            crash_userCoeff = now_iks
            crash_userWin = crash_userCoeff * crash_userBet        

            await query('UPDATE crash SET result = ?  WHERE id = ?', [crash_userCoeff, gameId])

            io.sockets.emit('crashUpdate', {
                type: '1',
                game_id: gameId,
                win_user: crash_userWin,
                user_id: crash_userId,
                coeff: crash_userCoeff
            })

            bankCrash -= crash_userWin
            winAllCrash -= crash_userBet

            console.log('Bank: '+bankCrash+' WinAllCrash: '+winAllCrash)

            var user_bd = await query('SELECT balance, demo_balance, type_balance FROM users WHERE id = ?', [crash_userId])

            type_balance = user_bd[0]['type_balance']

            if(type_balance == 0){
                balanceLast = user_bd[0]['balance']
                balanceNew = crash_userWin + user_bd[0]['balance']
                await query('UPDATE users SET balance = ?  WHERE id = ?', [balanceNew, crash_userId])
            }else{
                balanceLast = user_bd[0]['demo_balance']
                balanceNew = crash_userWin + user_bd[0]['demo_balance']
                await query('UPDATE users SET demo_balance = ?  WHERE id = ?', [balanceNew, crash_userId])
            }
            

            await io.sockets.emit('crashNoty', {
                balanceLast, balanceNew,
                win: crash_userWin,
                x:crash_userCoeff,
                user_id: crash_userId
            })

        }
        


    });

    socket.on('boomCrash', async function(msg) {
        crashBoom = 1
    });
});




io.sockets.on('connection', function(socket) {


    socket.on('message', function(data) {
        var newData = data.message;
        
    })    

    socket.on('BOOM_CONNECT', (e) => {
        socket.emit('BOOM_GET', { statusBoom, blocksBoom, timeBoom, bonusBoom, dicesBoom })
    })

     socket.on('PING_CONNECT', (e) => {
         socket.emit('PING_GET')
     })
}); 




redis.psubscribe('*', function(error, count) {

});

redis.on('pmessage', function(pattern, channel, message) {
    io.emit(channel, message);

});


function TIMES(e) {
    if (e < 10) {
        return '0' + e
    }
    return e
}

function shuffle(e) {
    return e.sort(() => Math.random() - 0.5);
}

function rand(min, max) {
    return Math.floor(Math.random() * (max - min)) + min;
}



// CRASH

async function waitCrash() {
    timerCrash = 15;
    statusCrash = 0;
    crashBoom = 0
    var preFinishCrash = false;
    await query('UPDATE settings SET crash_status = ?', [0])
    startCrash()
    return
}

waitCrash()

var now_iks = 0
var bankCrash = 0
var crashBoom = 0
var winAllCrash = 0
var betAllCrash = 0
var statusCrashGo = 0
var nowIksCrash = 0

var _i = 0;
var _now = 0;
var _data = [];
var _label = [];
var nowIksCrash = 0;
let crashRoundCount = 0;

function startCrash() {
    var timer_crash = 10
    var preFinishCrash = false;

    var intervalStartCrash = setTimeout(async function start_crash() {
        timer_crash -= 1
        io.sockets.emit('crashTitle', {
            text: timer_crash
        })
        if (timer_crash <= 1) {
            io.sockets.emit('crashPrepare')
            await query('UPDATE settings SET crash_status = ?', [1])
        }

        if (timer_crash <= 0 && !preFinishCrash) {
            crashRoundCount++;
            io.sockets.emit('crashGo')
            preFinishCrash = true
            statusCrashGo = 1

            intcrash_main = 0;
            const massiv_res = [
                100,200,200,200,500,500,400,300,300,300,
                400,400,300,300,400,550,700,1000,4000,20000
              ];
              shuffle(massiv_res);
              
              // 3) Случайный «сырой» верхний порог (целое, напр. 700 → 7.00)
              const upperRaw = massiv_res[
                Math.floor(Math.random() * massiv_res.length)
              ];
              
              let resultInt;
              
              const r4 = crashRoundCount % 4;
              
              if (r4 === 0) {
                  // каждый 4‑й раунд: 1.40–1.49
                  resultInt = rand(131, 148);            // [140…149] → 1.40–1.49
              }
              else if (r4 === 1) {
                  // сразу после: всегда >2.60, до 15.00
                  resultInt = rand(261, 1501);           // [261…1500] → 2.61–15.00
              }
              else {
                  // остальные раунды — полный рандом с заданными шансами
                  const p = Math.random() * 100;
              
                  if (p < 35) {
                      // 50% шанс 1.00–1.39
                      resultInt = rand(100, 129);        // [100…139]
                  }
                  else if (p < 35 + 25) {
                      // 35% шанс 1.50–1.99
                      resultInt = rand(150, 200);        // [150…199]
                  }
                  else if (p < 35 + 25 + 20) {
                      // 10% шанс 2.00–3.99
                      resultInt = rand(200, 400);        // [200…399]
                  }
                  else {
                      //  5% шанс 4.00–15.00
                      resultInt = rand(400, 1501);       // [400…1500]
                  }
              }
              
              // и в конце:
              result_crash = resultInt / 100;

            var sssss = await query('SELECT * FROM settings')

            bankCrash = sssss[0].crash_bank;

            var crash_boom = sssss[0].crash_boom;
            if (crash_boom != 0) {
                result_crash = crash_boom
            }


            start_plus = 0.01
            start_time = 300
            now_iks = 1
            nowIksCrash = 1

            _i = 0;
            _now = 0;
            _data = [];
            _label = [];

            await query('UPDATE settings SET crash_status = ?', [3])
            

            start_des = 0


            var off = 0
            var upd = 1

            var gameCrash = {};
            var gameCrashCoeffs1 = [];
            var gameCrashGo = 0
            var IndexCrash = 0

            const crash = await query('SELECT * FROM crash ORDER BY auto ASC')
            crash.forEach(function(e, i, arr) {
                if (gameCrash[e.auto] == null){
                    gameCrash[e.auto] = 0
                }
                countCoeff = gameCrash[e.auto]

                gameCrash[e.auto] =  countCoeff + 1
                gameCrashCoeffs1.push(e.auto)
                gameCrashGo = 1
            })

            gameCrashCoeffs = gameCrashCoeffs1.filter(function(item, pos) {
                return gameCrashCoeffs1.indexOf(item) == pos;
            })

            console.log(gameCrash)

            var select_crash_counting = await query('SELECT SUM(`bet`) FROM crash WHERE result = 0')
            winAllCrash = select_crash_counting[0]['SUM(`bet`)']
            if(winAllCrash == null){
                winAllCrash = 0
            }
            betAllCrash = winAllCrash
            console.log('Bank: '+bankCrash+' WinAllCrash: '+winAllCrash)

            var settings_crash = await query('SELECT * FROM settings')
            var youtube_crash = settings_crash[0].youtube_crash;
            var crash_bank = settings_crash[0].crash_bank;
            var crash_boom = settings_crash[0].crash_boom;
            var auto_crash = settings_crash[0].auto_crash;


            var intervalUpdateCrash = setTimeout(async function crash_upd() {

                var str = String(now_iks.toFixed(2));              


                if (youtube_crash == 0 && auto_crash == 1 && crash_boom == 0) {
                    console.log('Check')
                    if (winAllCrash * now_iks > bankCrash && winAllCrash > 0) {
                        off = 1
                        result_crash = now_iks
                    }
                }

                if (crash_boom != 0) {
                    if (crash_boom <= now_iks + start_plus) {
                        off = 1
                        result_crash = now_iks
                    }
                }

                if (now_iks + start_plus >= result_crash && crash_boom == 0) {
                    off = 1
                    result_crash = now_iks
                }

                if(crashBoom == 1){
                    off = 1
                    result_crash = now_iks
                }

                if(off != 1){
                    io.sockets.emit('crashTitle', {
                        play: 1,
                        text: str,
                        start_time,
                        data: _data,
                        label: _label
                    })
                }


                if (off == 1) {
                    statusCrashGo = 0

                    var sel_crash = await query('SELECT user_id, bet, id, auto FROM crash WHERE result = 0 and auto <= ?', [now_iks])

                    var sel_crash_bet = await query('SELECT SUM(`bet`) FROM crash WHERE result = 0 and auto <= ?', [now_iks])
                    bets = sel_crash_bet[0]['SUM(`bet`)']

                    var sel_crash_win = await query('SELECT SUM(`win`) FROM crash WHERE result = 0 and auto <= ?', [now_iks])
                    wins = sel_crash_win[0]['SUM(`win`)']

                    bankCrash -= wins
                    winAllCrash -= bets

                    console.log('Bank: '+bankCrash+' WinAllCrash: '+winAllCrash)

                    await io.sockets.emit('crashUpdate', {
                        type: '2',
                        publishMassiv: sel_crash,
                    })

                    // await client.query('UPDATE crash SET result = auto * bet  WHERE result = 0 and auto <= ?', [now_iks])

                    sel_crash.forEach(async function(e, i, arr) {
                        // transform: 100px;
                        // await notyUserCrash()
                        

                        crash_userId = e.user_id
                        crash_userBet = e.bet
                        gameId = e.id

                        crash_userCoeff = e.auto
                        crash_userWin = crash_userCoeff * crash_userBet        
                        
                        await query('UPDATE crash SET result = ?  WHERE id = ?', [crash_userCoeff, gameId])

                        var user_bd = await query('SELECT balance, demo_balance, type_balance FROM users WHERE id = ?', [crash_userId])

                        type_balance = user_bd[0]['type_balance']

                        if(type_balance == 0){
                            balanceLast = user_bd[0]['balance']
                            balanceNew = crash_userWin + user_bd[0]['balance']
                            await query('UPDATE users SET balance = ?  WHERE id = ?', [balanceNew, crash_userId])
                        }else{
                            balanceLast = user_bd[0]['demo_balance']
                            balanceNew = crash_userWin + user_bd[0]['demo_balance']
                            await query('UPDATE users SET demo_balance = ?  WHERE id = ?', [balanceNew, crash_userId])
                        }
                        

                        io.sockets.emit('crashNoty', {
                            balanceLast, balanceNew,
                            win: crash_userWin,
                            x:crash_userCoeff,
                            user_id: crash_userId
                        })

                    })

                    result_crash = now_iks
                    
                    var str = String(result_crash.toFixed(2));
                    io.sockets.emit('crashTitle', {
                        text: str,
                        play: 1,
                        start_time: 20,
                        data: _data,
                        label: _label
                    })

                    await query('UPDATE settings SET crash_status = 2, crash_boom = 0, crash_result = 0, youtube_crash = 0')



                    io.sockets.emit('crashDead', {text: str})

                    console.log('Win wait...')

                    typeCrashWin = 'False'
                    
                    typeCrashWin = await winUserCrash()
                    
                    console.log('Win done...') 

                    var selectcrash = await query('SELECT * FROM crash')
                    var arr_win = []
                    var arr_lose = []
                    selectcrash.forEach(function(e, i, arr) {

                        if (e.result != 0) {
                            bet_user = e.bet
                            win_user = bet_user * e.result
                            game_user = e.user_id
                            arr_win.push({
                                user_id: e.user_id,
                                win_user
                            })
                        } else {
                            arr_lose.push({
                                id: e.id
                            })
                        }
                    })

                    if (youtube_crash == 0 && auto_crash == 1 && crash_boom == 0) {
                        await query('UPDATE settings SET crash_bank = ?', [bankCrash])
                    }else{
                        await query('UPDATE settings SET crash_bank = crash_bank - ?', [betAllCrash])
                    }

                    await query('TRUNCATE crash')
                    var str = String(result_crash.toFixed(2));
                    await query('INSERT INTO `crash_history` (`num`) VALUES (?)', [result_crash])
                    const s = await query('SELECT * FROM crash_history order by id desc LIMIT 0,30')
                    now_iks = 0

                    io.sockets.emit('crashFinish', {
                        s,
                        arr_win,
                        arr_lose
                    })


                    setTimeout(() => {
                        io.sockets.emit('crashClear')
                    }, 4000)
                    setTimeout(waitCrash, 5000)
                    return

                } else {



                    if(gameCrashGo == 1){
                        if(gameCrashCoeffs[IndexCrash] <= now_iks){
                            IndexCrash += 1
                            upd = 0
                            var sel_crash = await query('SELECT user_id, bet, id, auto FROM crash WHERE result = 0 and auto <= ?', [now_iks])
                            
                            var sel_crash_bet = await query('SELECT SUM(`bet`) FROM crash WHERE result = 0 and auto <= ?', [now_iks])
                            bets = sel_crash_bet[0]['SUM(`bet`)']

                            var sel_crash_win = await query('SELECT SUM(`win`) FROM crash WHERE result = 0 and auto <= ?', [now_iks])
                            wins = sel_crash_win[0]['SUM(`win`)']

                            bankCrash -= wins
                            winAllCrash -= bets

                            console.log('Bank: '+bankCrash+' WinAllCrash: '+winAllCrash)

                            await io.sockets.emit('crashUpdate', {
                                type: '2',
                                publishMassiv: sel_crash
                            })



                            sel_crash.forEach(async function(e, i, arr) {

                                crash_userId = e.user_id
                                crash_userBet = e.bet
                                gameId = e.id

                                crash_userCoeff = e.auto
                                crash_userWin = crash_userCoeff * crash_userBet        

                                await query('UPDATE crash SET result = ?  WHERE id = ?', [crash_userCoeff, gameId])

                                var user_bd = await query('SELECT balance, demo_balance, type_balance FROM users WHERE id = ?', [crash_userId])

                                type_balance = user_bd[0]['type_balance']

                                if(type_balance == 0){
                                    balanceLast = user_bd[0]['balance']
                                    balanceNew = crash_userWin + user_bd[0]['balance']
                                    await query('UPDATE users SET balance = ?  WHERE id = ?', [balanceNew, crash_userId])
                                }else{
                                    balanceLast = user_bd[0]['demo_balance']
                                    balanceNew = crash_userWin + user_bd[0]['demo_balance']
                                    await query('UPDATE users SET demo_balance = ?  WHERE id = ?', [balanceNew, crash_userId])
                                }
                                

                                await io.sockets.emit('crashNoty', {
                                    balanceLast, balanceNew,
                                    win: crash_userWin,
                                    x:crash_userCoeff,
                                    user_id: crash_userId
                                })

                                // await crashPublish(gameId, crash_userWin, crash_userId, crash_userCoeff)

                                
                                // bankCrash -= crash_userWin
                                // winAllCrash -= crash_userBet


                            })

                        }
                    }





                    _i++;
                    _now = parseFloat(Math.pow(Math.E, 0.00006*_i*1000/20));
                    now_iks = _now

                    _data.push(_now);
                    _label.push(_i);
                    
                    // console.log(now_iks)
                    
                    // start_des += 1
                    // if (start_des == 10 && start_time > 20) {
                    //     start_des = 0;
                    //     start_plus += 0.005
                    //     start_time -= 0.07
                    // }
                }


                var intervalUpdateCrash = setTimeout(crash_upd, 50);

            }, 50);
} else {
    var intervalStartCrash = setTimeout(start_crash, 1000);
}
}, 1000);


}

async function notyUserCrash() {
    await io.sockets.emit('crashUpdate', {
        type: '2',
        publishMassiv: sel_crash
    })
}

async function crashPublish(gameId, crash_userWin, crash_userId, crash_userCoeff){
    await io.sockets.emit('crashUpdate', {
        type: '1',
        game_id: gameId,
        win_user: crash_userWin,
        user_id: crash_userId,
        coeff: crash_userCoeff
    })
}


async function winUserCrash() {

    await requestify.request(domain + '/api/wincrash', {
        method: 'GET'
    })
    .then(async function(response) {
        response = response.body;
        console.log(response)
        return 'True'
    })
    .fail(async function(response) {
        console.log('response Error', response.getCode());
        return "False";

    });
}
// END CRASH



function fakegames() {
    setInterval(async() => {
        await requestify.request(domain+'/api/fakecreate2', {
            method: 'GET'
        })
        .then(async function(response) {
            console.log(response.body);
        })
    }, rand(10, 60) * 50);
}

fakegames()


};