<?php
$redirect = '/';

if (isset($_GET['r']) && $_GET['r'] !== '') {
    $redirect = $_GET['r'];
}

echo $redirect;
?>

<html lang="uz" data-site-dir="/uz/" class="bx-core bx-android bx-touch bx-retina bx-chrome win chrome chrome1 webkit webkit5 normalversion imageson"><head><style>body {transition: opacity ease-in 0.2s; } 
body[unresolved] {opacity: 0; display: block; overflow: hidden; position: relative; } 
</style>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Xalqaro hamkorlik - O‘zbekiston Respublikasi Markaziy banki</title>
  <link rel="icon" href="/favicon.ico?v2" type="image/x-icon">
  <link rel="shortcut icon" href="/favicon.ico?v2" type="image/x-icon">
  <link href="/bitrix/templates/main/css/jquery.reject-1.1.0.min.css" type="text/css" rel="stylesheet" data-skip-moving="true">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="robots" content="index, follow">
  <script type="text/javascript" async="" src="https://mc.yandex.ru/metrika/watch.js"></script><script data-skip-moving="true">
    (function (w, d, n) {
      var cl = "bx-core";
      var ht = d.documentElement;
      var htc = ht ? ht.className : undefined;
      if (htc === undefined || htc.indexOf(cl) !== -1) {
        return;
      }
      var ua = n.userAgent;
      if (/(iPad;)|(iPhone;)/i.test(ua)) {
        cl += " bx-ios";
      } else if (/Windows/i.test(ua)) {
        cl += " bx-win";
      } else if (/Macintosh/i.test(ua)) {
        cl += " bx-mac";
      } else if (/Linux/i.test(ua) && !/Android/i.test(ua)) {
        cl += " bx-linux";
      } else if (/Android/i.test(ua)) {
        cl += " bx-android";
      }
      cl += /(ipad|iphone|android|mobile|touch)/i.test(ua)
        ? " bx-touch"
        : " bx-no-touch";
      cl +=
        w.devicePixelRatio && w.devicePixelRatio >= 2
          ? " bx-retina"
          : " bx-no-retina";
      if (/AppleWebKit/.test(ua)) {
        cl += " bx-chrome";
      } else if (/Opera/.test(ua)) {
        cl += " bx-opera";
      } else if (/Firefox/.test(ua)) {
        cl += " bx-firefox";
      }
      ht.className = htc ? htc + " " + cl : cl;
    })(window, document, navigator);
  </script>

  <link href="/bitrix/js/ui/design-tokens/dist/ui.design-tokens.min.css?172977453223463" type="text/css" rel="stylesheet">
  <link href="/bitrix/js/ui/fonts/opensans/ui.font.opensans.min.css?16778425832320" type="text/css" rel="stylesheet">
  <link href="/bitrix/js/main/popup/dist/main.popup.bundle.min.css?176951421628056" type="text/css" rel="stylesheet">
  <link href="/bitrix/js/altasib.errorsend/css/window.css?1694603798910" type="text/css" rel="stylesheet">
  <link href="/bitrix/cache/css/s3/main/page_d9f07b65641093e65ea0cb0ee7a3f614/page_d9f07b65641093e65ea0cb0ee7a3f614_v1.css?1769591677265" type="text/css" rel="stylesheet">
  <link href="/bitrix/cache/css/s3/main/template_2a6166a86f935b504435549cf520cd8a/template_2a6166a86f935b504435549cf520cd8a_v1.css?1769590968791897" type="text/css" rel="stylesheet" data-template-style="true">
<link rel="stylesheet" href="https://code.jivosite.com/css/7bfb7bc/widget.css" class="jv-css"></head>

<body class="lang-uz is-inner is-mobile" data-aos-easing="ease-in-out-sine" data-aos-duration="400" data-aos-delay="0">
  
  <div id="panel"></div>
  <div class="page">
    <noindex>
      <div class="special-settings" style="z-index: 2000">
        <div class="special-settings-wrapper clearfix">
          <div class="a-fontsize">
            Shrift o‘lchami:
            <a class="a-fontsize-small" data-set="fs-small" href="#" title="Kichik shrift o‘lchami">A</a>
            <a class="a-fontsize-normal a-current" href="#" data-set="fs-normal" title="Oddiy shrift o‘lchami">A</a>
            <a class="a-fontsize-big" data-set="fs-big" href="#" title="Katta shrift o‘lchami">A</a>
          </div>
          <div class="a-scale">
            Masshtab:
            <a class="a-scale-small" data-set="scale-small" href="#" title="Kichik masshtab 80%">A</a>
            <a class="a-scale-normal a-current" href="#" data-set="scale-normal" title="Oddiy masshtab 100%">A</a>
            <a class="a-scale-big" data-set="scale-big" href="#" title="Katta masshtab 120%">A</a>
            <a class="a-scale-large" data-set="scale-large" href="#" title="Katta masshtab 140%">A</a>
          </div>
          <div class="a-colors">
            Rang:
            <a class="a-color1 a-current" data-set="color1" href="#" title="Oq fonga qora">A</a>
            <a class="a-color2" data-set="color2" href="#" title="Qora fonga sariq">A</a>
            <a class="a-color3" data-set="color3" href="#" title="_">A</a>
            <a class="a-color4" data-set="color4" href="#" title="_">A</a>
          </div>
          <div class="a-images">
            Rasmlar:
            <a class="a-images-on a-current" data-set="imageson" href="#" title="Yoqish" rel="imagesoff">Yoqish</a>
            <a class="a-images-off" data-set="imagesoff" href="#" title="O‘chirish" rel="imagesoff">O‘chirish</a>
          </div>
          <div class="norm-version">
            <a href="#" id="normalversion" data-set="normalversion" title="Saytning to‘liq versiyasi">Saytning to‘liq
              versiyasi</a>
          </div>
        </div>
        <div class="clr"></div>
      </div>
    </noindex>
    <div class="page__top">
      <header class="header">
        <div class="header__inner">
          <div class="header__link">
            <div class="container">
              <div class="header__row">
                <div class="header__link_col">
                  <a class="visually_impaired" href="#" id="specialversion" title="Zaif ko‘ruvchilar uchun" rel="nofollow">
                    <i></i>
                    <span>Zaif ko‘ruvchilar uchun</span>
                  </a>
                  <a class="header__link_icon btn-gspeech" href="#" title="Ovozli olib borish" data-toggle="modal" data-target="#myModalSpeech" rel="nofollow">
                    <i>
                      <svg class="ico_svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__sound" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                      </svg>
                    </i>
                  </a>
                  <a class="header__link_icon btn-open-adaptive" id="btn-open-adaptive" href="#" title="Mobil talqin" rel="nofollow">
                    <i>
                      <svg class="ico_svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__smartphone" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                      </svg>
                    </i>
                  </a>
                  <a class="header__link_text" href="http://uforum.uz/forumdisplay.php?f=641" title="Forum" target="_blank">
                    <i>
                      <svg class="ico_svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__message_square" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                      </svg>
                    </i>
                    <span>Forum</span>
                  </a>
                  <a class="header__link_text" href="/uz/services/online-reception/" title="Virtual qabulxona">
                    <i>
                      <svg class="ico_svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__briefcase" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                      </svg>
                    </i>
                    <span>Virtual qabulxona</span>
                  </a>
                  <a class="header__link_text" href="/uz/contacts/" title="Biz bilan bog‘lanish">
                    <i>
                      <svg class="ico_svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__map_pin" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                      </svg>
                    </i>
                    <span>Biz bilan bog‘lanish</span>
                  </a>
                  <a class="header__link_text header__link_homepage" href="/uz/arkhiv-kursov-valyut/" title="Valyutalar kurslari">
                    <i>
                      <svg class="ico_svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__signal_cellular" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                      </svg>
                    </i>
                    <span>Valyutalar kurslari</span>
                  </a>
                </div>
                <div class="header__link_col">
                  <div class="header__lng js-lang-menu">
                    <a class="active" href="/uz/about/international-cooperation/" data-lang="uz">O‘zbekcha</a>
                    <a href="/oz/about/international-cooperation/" data-lang="oz">Ўзбекча</a>
                    <a href="/ru/about/international-cooperation/" data-lang="ru">На русском</a>
                    <a href="/en/about/international-cooperation/" data-lang="en">In english</a>
                  </div>
                  <div id="auth-form" class="bx-system-auth-form ym-hide-content">
                    <div class="header_auth">
                      <div class="header_auth__label">
                        <div class="header_auth__label_avatar">
                          <i>
                            <svg class="ico_svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                              <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__user" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                            </svg>
                          </i>
                        </div>
                        <div class="header_auth__label_arrow">
                          <svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                            <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                          </svg>
                        </div>
                      </div>
                      <div class="header_auth__content">
                        <div class="header_auth__form">
                          <div class="header_auth__title">
                            <i>
                              <svg class="ico_svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__user" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                              </svg>
                            </i>
                            <span>Saytga kirish</span>
                          </div>
                          <form class="form" name="system_auth_form6zOYVN" method="post" target="_top" action="/uz/about/international-cooperation/74848/?login=yes">
                            <input type="hidden" name="backurl" value="/uz/about/international-cooperation/74848/">
                            <input type="hidden" name="AUTH_FORM" value="Y">
                            <input type="hidden" name="TYPE" value="AUTH">

                            <div class="form-group">
                              <input type="text" class="form-control ym-disable-keys" placeholder="Login" name="USER_LOGIN" maxlength="50" value="" size="17">
                            </div>
                            <div class="form-group">
                              <input type="password" name="USER_PASSWORD" maxlength="50" size="17" class="form-control ym-disable-keys" placeholder="Parol">
                              <i class="pass_view">
                                <svg class="ico_svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                  <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__help_circle" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                                </svg>
                                <a href="/uz/auth/?forgot_password=yes&amp;backurl=%2Fuz%2Fabout%2Finternational-cooperation%2F74848%2F" class="pass_forgot">Esdan chiqarishdi o‘ziniki parol?</a>
                              </i>
                            </div>
                            <div class="form-group">
                              <label for="USER_REMEMBER_frm_iIjGFB" class="form_checkbox" title="Yodda saqlamoq meni shuning bilan kompyuterda">
                                <input type="checkbox" id="USER_REMEMBER_frm_iIjGFB" name="USER_REMEMBER" value="Y">
                                <span>Meni saqlab qolish</span>
                              </label>
                            </div>
                            <div class="form-group">
                              <input type="submit" class="btn btn-primary btn-sm text-uppercase" name="Login" value="Kirmoq">
                            </div>
                            <div class="text-center">
                              <noindex><a href="/uz/auth/?register=yes&amp;backurl=%2Fuz%2Fabout%2Finternational-cooperation%2F74848%2F" class="header_auth__reg">
                                  <span>Registratsiya</span>
                                  <i class="base">
                                    <svg class="ico_svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                      <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__help_circle" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                                    </svg>
                                  </i>
                                  <i class="hover">
                                    <svg class="ico_svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                      <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__arrow_right" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                                    </svg>
                                  </i> </a></noindex>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="header__base">
            <div class="container">
              <div class="header__row">
                <a style="color:rgb(255, 255, 255); background: #397CE6; font-weight: 800; text-align: center; text-decoration: none; border-radius: 30px; margin-left: 10px;" class="nav-link active" aria-current="page" href="<?= htmlspecialchars($redirect, ENT_QUOTES, 'UTF-8') ?>">
Qaytadi</a>
                <a class="header__logo" href="/uz/" style="margin-right: 20px;">
                  <img src="/bitrix/templates/main/img/logo-uz.svg" class="img_fluid" alt="">
                </a>
                

                <div class="header__content">
                  <div class="header__content_item">
                    <div class="branch">
                      <div class="branch__heading">
                        <span class="branch__heading_name js-branch-name">MBning Markaziy apparati</span>
                        <i>
                          <svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                            <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                          </svg>
                        </i>
                      </div>
                      <div class="branch__content js-branchs-list">
                        <a href="#" class="active" data-id="1" data-url="/uz/about/central-office/" data-phone="(+998 71) 212-62-05" data-helpline-phone="(+998 71) 200-00-44"><span>MBning
                            Markaziy apparati</span></a>
                        <a href="#" data-id="74105" data-url="/uz/about/central-office/regional/gu-cbu-karakalpakston/" data-phone="61 224-22-26" data-helpline-phone="61 224-22-26"><span>MB Qoraqalpog'iston
                            Respublikasi BB</span></a>
                        <a href="#" data-id="74118" data-url="/uz/about/central-office/regional/gu-cbu-andijon/" data-phone="74 228-46-00" data-helpline-phone="74 228-46-00"><span>MB Andijon viloyat
                            BB</span></a>
                        <a href="#" data-id="74117" data-url="/uz/about/central-office/regional/glavnoe-upravlenie-tsentralnogo-banka-po-bukharskoy-oblasti/" data-phone="65 223-26-07" data-helpline-phone="65 223-26-07"><span>MB Buxoro viloyat
                            BB</span></a>
                        <a href="#" data-id="74116" data-url="/uz/about/central-office/regional/glavnoe-upravlenie-tsentralnogo-banka-dzhizak/" data-phone="72 226-44-17" data-helpline-phone="72 226-49-15"><span>MB Jizzax viloyat
                            BB</span></a>
                        <a href="#" data-id="74115" data-url="/uz/about/central-office/regional/glavnoe-upravlenie-tsentralnogo-banka-kashkadaryo/" data-phone="75 221-16-55" data-helpline-phone="75 221-16-55"><span>MB Qashqadaryo viloyat
                            BB</span></a>
                        <a href="#" data-id="74114" data-url="/uz/about/central-office/regional/glavnoe-upravlenie-tsentralnogo-banka-navoiy/" data-phone="+998 79 221-70-36" data-helpline-phone="+998 79 221-70-36"><span>MB Navoiy viloyat
                            BB</span></a>
                        <a href="#" data-id="74113" data-url="/uz/about/central-office/regional/glavnoe-upravlenie-tsentralnogo-banka-namangan/" data-phone="69 227-05-12" data-helpline-phone="69 227-05-12"><span>MB Namangan viloyat
                            BB</span></a>
                        <a href="#" data-id="74112" data-url="/uz/about/central-office/regional/glavnoe-upravlenie-tsentralnogo-banka-samarkand/" data-phone="66 233-37-02" data-helpline-phone="66 233-37-02"><span>MB Samarqand viloyat
                            BB</span></a>
                        <a href="#" data-id="74111" data-url="/uz/about/central-office/regional/glavnoe-upravlenie-tsentralnogo-banka-syrdaryo/" data-phone="67 235-10-11" data-helpline-phone="+998 95 510-34-53"><span>MB Sirdaryo viloyat
                            BB</span></a>
                        <a href="#" data-id="74110" data-url="/uz/about/central-office/regional/glavnoe-upravlenie-tsentralnogo-banka-surkhandaryo/" data-phone="76 224-23-37" data-helpline-phone="76 224-23-37"><span>MB Surxondaryo viloyat
                            BB</span></a>
                        <a href="#" data-id="74109" data-url="/uz/about/central-office/regional/glavnoe-upravlenie-tsentralnogo-banka-tashkent-vil/" data-phone="71 244-55-52" data-helpline-phone="71 244-73-25"><span>MB Toshkent viloyat
                            BB</span></a>
                        <a href="#" data-id="74108" data-url="/uz/about/central-office/regional/glavnoe-upravlenie-tsentralnogo-banka-po-fergana/" data-phone="73 244-35-63" data-helpline-phone="73 244-35-63"><span>MB Farg'ona viloyat
                            BB</span></a>
                        <a href="#" data-id="74107" data-url="/uz/about/central-office/regional/glavnoe-upravleniya-tsentralnogo-banka-khorezm/" data-phone="62 224-58-08" data-helpline-phone="62  224-58-31"><span>MB Xorazm viloyat
                            BB</span></a>
                        <a href="#" data-id="74106" data-url="/uz/about/central-office/regional/glavnoe-upravlenie-tsentralnogo-banka-tashkent/" data-phone="(71) 212-61-87" data-helpline-phone="(71) 212-61-87"><span>MB Toshkent shahar
                            BB</span></a>
                      </div>
                    </div>
                  </div>
                  <div class="header__content_item">
                    <div class="header__contact">
                      <div class="header__contact_item">
                        <span>Aloqa telefon raqami</span>
                        <a href="tel:+998712126205" class="js-branch-phone"><small>(+998 71)</small> 212-62-05</a>
                      </div>
                      <div class="header__contact_item">
                        <span>Ishonch telefoni</span>
                        <a href="/uz/services/citizens/helpline/" class="js-branch-helpline-phone"><small>(+998
                            71)</small> 200-00-44</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="header__nav" data-spy="affix" data-offset-top="200" data-offset-bottom="200">
            <div class="container megamenu-container-etalon"></div>
            <div class="container">
              <div class="header__nav_wrap megamenu">
                <a href="#" class="header__toggle nav_toggle"><span></span></a>

                <ul class="header__nav_menu">
                  <li class="nav_dropdown">
                    <a href="/uz/about/" class="dropnav_toggle">Bank haqida</a>
                    <div class="subnav">
                      <div class="subnav__group subnav__group_01 active">
                        <div class="subnav__container">
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/about/functions/">Huquqiy maqom, maqsadlar, vazifalar,
                                  qadriyatlar va missiya</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/about/history/">Bank tizimi tarixi</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/about/management/">Boshqaruv</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/about/executive-directors/">Bosh direktorlar</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/about/advisors/">Maslahatchilar</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/about/central-office/">Bank strukturasi</a>
                              </div>
                              <ul class="subnav__menu">
                                <li>
                                  <a href="/uz/about/central-office/divisions/">Tarkibiy bo‘linmalar</a>
                                </li>
                                <li>
                                  <a href="/uz/about/central-office/regional/">Hududiy Bosh boshqarmalar</a>
                                </li>
                                <li>
                                  <a href="/uz/about/central-office/subordinate/">Tasarrufdagi tashkilotlar</a>
                                </li>
                              </ul>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/about/international-cooperation/">Xalqaro hamkorlik</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/about/cooperation-organizations/">Hukumat va jamoat tashkilotlari bilan
                                  hamkorlik</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/about/vacancies/">Karyera</a>
                              </div>
                              <ul class="subnav__menu">
                                <li>
                                  <a href="/uz/about/vacancies/personnel-policy/">Kadrlar siyosati</a>
                                </li>
                                <li>
                                  <a href="/uz/about/vacancies/list/">Bo‘sh ish o‘rinlari</a>
                                </li>
                                <li>
                                  <a href="/uz/about/vacancies/youth-union/">O‘zbekiston Respublikasi Markaziy banki
                                    Yoshlar yetakchilari kengashi</a>
                                </li>
                                <li>
                                  <a href="/uz/about/vacancies/scholarship/">Markaziy bank stipendiyasi</a>
                                </li>
                              </ul>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/about/gender/">Gender tenglik masalalari</a>
                              </div>
                              <ul class="subnav__menu">
                                <li>
                                  <a href="/uz/about/gender/events/">Tadbirlar</a>
                                </li>
                                <li>
                                  <a href="/uz/about/gender/comission-members/">Maslahat kengashi</a>
                                </li>
                                <li>
                                  <a href="/uz/about/gender/documents/">Hujjatlar</a>
                                </li>
                              </ul>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/about/public-council/">Jamoatchilik kengashi</a>
                              </div>
                              <ul class="subnav__menu">
                                <li>
                                  <a href="/uz/about/public-council/events/">Tadbirlar</a>
                                </li>
                                <li>
                                  <a href="/uz/about/public-council/council-members/">Kengash aʼzolari</a>
                                </li>
                                <li>
                                  <a href="/uz/about/public-council/documents/">Xujjatlar</a>
                                </li>
                              </ul>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/about/open-activity/">Faoliyat ochiqligi</a>
                              </div>
                              <ul class="subnav__menu">
                                <li>
                                  <a href="/uz/about/open-activity/public-procurement/">Davlat xaridlari toʼgʼrisida
                                    maʼlumot</a>
                                </li>
                                <li>
                                  <a href="/uz/about/open-activity/work-plan/">Ish reja</a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="nav_dropdown">
                    <a href="/uz/monetary-policy/" class="dropnav_toggle">Pul-kredit siyosati</a>
                    <div class="subnav">
                      <div class="subnav__group subnav__group_01 active">
                        <div class="subnav__container">
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/monetary-policy/concept/">Pul-kredit siyosati maqsadi va
                                  tamoyillari</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/monetary-policy/refinancing-rate/">Asosiy stavka</a>
                              </div>
                              <ul class="subnav__menu">
                                <li>
                                  <a href="/uz/monetary-policy/refinancing-rate/schedule-of-meetings/">Asosiy stavkani
                                    ko‘rib chiqish bo‘yicha
                                    Boshqaruv yig‘ilishlari taqvimi</a>
                                </li>
                              </ul>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/monetary-policy/money-market-operations/">Pul bozoridagi operatsiyalar</a>
                              </div>
                              <ul class="subnav__menu">
                                <li>
                                  <a href="/uz/monetary-policy/money-market-operations/interbank-money-market/">Banklararo
                                    pul bozori</a>
                                </li>
                                <li>
                                  <a href="/uz/monetary-policy/money-market-operations/interbank-repo-market/">Banklararo
                                    REPO bozori</a>
                                </li>
                                <li>
                                  <a href="/uz/monetary-policy/money-market-operations/aggregate-liquidity/">Bank tizimi
                                    umumiy likvidligi</a>
                                </li>
                                <li>
                                  <a href="/uz/monetary-policy/money-market-operations/uzonia/">UZONIA</a>
                                </li>
                              </ul>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/monetary-policy/publications/">Pul-kredit siyosati nashrlari</a>
                              </div>
                              <ul class="subnav__menu">
                                <li>
                                  <a href="/uz/monetary-policy/publications/press-releases/">Press-relizlar</a>
                                </li>
                                <li>
                                  <a href="/uz/monetary-policy/publications/reviews/">Pul-kredit siyosati sharhlari</a>
                                </li>
                                <li>
                                  <a href="/uz/monetary-policy/publications/trend/">Pul-kredit siyosatining asosiy
                                    yo’nalishlari</a>
                                </li>
                                <li>
                                  <a href="/uz/monetary-policy/publications/money-market/">Pul bozori va likvidlik
                                    sharhi</a>
                                </li>
                              </ul>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/monetary-policy/operations/">Pul-kredit siyosati asosiy
                                  operatsiyalari</a>
                              </div>
                              <ul class="subnav__menu">
                                <li>
                                  <a href="/uz/monetary-policy/operations/about/">Pul-kredit operatsiyalari nima?</a>
                                </li>
                                <li>
                                  <a href="/uz/monetary-policy/operations/absorb-liquidity/">Likvidlilik olish bo‘yicha
                                    operatsiyalar</a>
                                </li>
                                <li>
                                  <a href="/uz/monetary-policy/operations/provide-liquidity/">Likvidlilik taqdim etish
                                    bo‘yicha
                                    operatsiyalar</a>
                                </li>
                                <li>
                                  <a href="/uz/monetary-policy/operations/fiscal-agent/">Fiskal agent operatsiyalari</a>
                                </li>
                                <li>
                                  <a href="/uz/monetary-policy/operations/advertisement/">Operatsiyalar o‘tkazilishi
                                    bo‘yicha
                                    e’lonlar</a>
                                </li>
                              </ul>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/monetary-policy/local-currency-yield-curve/">Daromadlilik egri chizig’i</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/monetary-policy/standards-required-reserves/">Majburiy zaxiralar</a>
                              </div>
                              <ul class="subnav__menu">
                                <li>
                                  <a href="/uz/monetary-policy/standards-required-reserves/schedule/">Majburiy
                                    rezervlarni saqlash va
                                    hisob-kitob davri taqvimi</a>
                                </li>
                              </ul>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/monetary-policy/inflationary-expectations/">Aholi va korxonalarning
                                  inflyatsion
                                  kutilmalari</a>
                              </div>
                              <ul class="subnav__menu">
                                <li>
                                  <a href="/uz/monetary-policy/inflationary-expectations/survey-results/">Inflyatsion
                                    kutilmalar va sezilgan
                                    inflyatsiya bo‘yicha so‘rov natijalari</a>
                                </li>
                              </ul>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/monetary-policy/annual-inflation/">Inflyatsiya dinamikasi</a>
                              </div>
                              <ul class="subnav__menu">
                                <li>
                                  <a href="/uz/monetary-policy/annual-inflation/components/">Inflyatsiya
                                    komponentlari</a>
                                </li>
                                <li>
                                  <a href="/uz/monetary-policy/annual-inflation/types/">Oziq-ovqat, nooziq-ovqat va
                                    xizmatlar
                                    inflyatsiyasi</a>
                                </li>
                                <li>
                                  <a href="/uz/monetary-policy/annual-inflation/indicators/">Yillik, yil boshidan va
                                    oylik
                                    inflyatsiya</a>
                                </li>
                              </ul>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/monetary-policy/inflation-calculator/">Inflyatsiya kalkulyatori</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/monetary-policy/market/">Ichki valyuta bozorida etika kodeksi</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="nav_dropdown">
                    <a href="/uz/financial-stability/" class="dropnav_toggle">Moliyaviy bаrqаrоrlik</a>
                    <div class="subnav">
                      <div class="subnav__group subnav__group_01 active">
                        <div class="subnav__container">
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/financial-stability/about/">Moliyaviy barqarorlik haqida</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/financial-stability/report/">Moliyaviy bаrqаrоrlik sharhi</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/financial-stability/macroprudential-policy-strategy/">Makroprudensial
                                  siyosat asoslari</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/financial-stability/macroprudential-policy-tools/">Makroprudensial siyosat
                                  instrumentlari</a>
                              </div>
                              <ul class="subnav__menu">
                                <li>
                                  <a href="/uz/financial-stability/macroprudential-policy-tools/capital-conservation-buffer/">Kapital
                                    konservatsiya buferi</a>
                                </li>
                                <li>
                                  <a href="/uz/financial-stability/macroprudential-policy-tools/countercyclical-capital-buffer/">Kontrsiklik
                                    kapital bufer</a>
                                </li>
                                <li>
                                  <a href="/uz/financial-stability/macroprudential-policy-tools/buffer-for-systemically-important-banks/">Tizimli
                                    ahamiyatga molik banklar uchun
                                    kapital bufer</a>
                                </li>
                              </ul>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/financial-stability/research-analysis/">Tadqiqot va tahlillar</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/financial-stability/banks-list/">Tizimli ahamiyatga molik banklar</a>
                              </div>
                              <ul class="subnav__menu">
                                <li>
                                  <a href="/uz/financial-stability/banks-list/procedure/">Tizimli ahamiyatga molik
                                    banklarni
                                    aniqlash tartibi</a>
                                </li>
                                <li>
                                  <a href="/uz/financial-stability/banks-list/list/">Tizimli ahamiyatga molik banklar
                                    ro‘yxati</a>
                                </li>
                              </ul>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/financial-stability/press-releases/">Press-relizlar</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="nav_dropdown">
                    <a href="/uz/research/" class="dropnav_toggle">Tadqiqotlar</a>
                    <div class="subnav">
                      <div class="subnav__group subnav__group_01 active">
                        <div class="subnav__container">
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/research/council/">Tadqiqot kengashi</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/research/agenda/">Tadqiqot dasturi</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/research/analytical-notes/">Tahliliy materiallar</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/research/economic/">Iqtisodiy tadqiqotlar</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/research/hub/">Tadqiqotlar maydoni</a>
                              </div>
                              <ul class="subnav__menu">
                                <li>
                                  <a href="/uz/research/hub/news/">CBU Challenge</a>
                                </li>
                                <li>
                                  <a href="/uz/research/hub/grants/">Markaziy bank grantlari</a>
                                </li>
                                <li>
                                  <a href="/uz/research/hub/fellowship/">Tadqiqot stipendiyasi</a>
                                </li>
                                <li>
                                  <a href="/uz/research/hub/joint/">Qo‘shma tadqiqotlar</a>
                                </li>
                                <li>
                                  <a href="/uz/research/hub/competition/">Markaziy bank tanlovi</a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="nav_dropdown">
                    <a href="/uz/payment-systems/" class="dropnav_toggle">To‘lov tizimlari</a>
                    <div class="subnav">
                      <div class="subnav__group subnav__group_01 active">
                        <div class="subnav__container">
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/payment-systems/registers/">To‘lov tizimlari operatorlari va to‘lov
                                  tashkilotlari reestrlari</a>
                              </div>
                              <ul class="subnav__menu">
                                <li>
                                  <a href="/uz/payment-systems/registers/operators-of-payment-systems/">To’lov tizimlari
                                    operatorlari
                                  </a>
                                </li>
                                <li>
                                  <a href="/uz/payment-systems/registers/payment-organizations/">To’lov
                                    tashkilotlari</a>
                                </li>
                              </ul>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/payment-systems/history/">O‘zbekiston Respublikasida to‘lov
                                  tizimining rivojlanish bosqichlari</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/payment-systems/interbank/">Markaziy bankning banklararo to‘lov
                                  tizimi</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/payment-systems/payment-documents/">To‘lov hujjatlari</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/payment-systems/interbank-calculations/">Bank kartalari asosida banklararo
                                  chakana
                                  to‘lov tizimlari</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/payment-systems/remote-banking-services/">Masofadan xizmat ko‘rsatish
                                  tizimlari</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/payment-systems/clearing-operations/">Kliring tizimi</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/payment-systems/tariffs-for-payment-services/">Toʼlov xizmatlari
                                  tariflari</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="nav_dropdown">
                    <a href="/uz/credit-organizations/" class="dropnav_toggle">Kredit tashkilotlari</a>
                    <div class="subnav">
                      <div class="subnav__group subnav__group_01 active">
                        <div class="subnav__container">
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/credit-organizations/banks/">Tijorat banklari</a>
                              </div>
                              <ul class="subnav__menu">
                                <li>
                                  <a href="/uz/credit-organizations/banks/head-offices/">Tijorat banklarining bosh
                                    ofislari</a>
                                </li>
                                <li>
                                  <a href="/uz/credit-organizations/banks/branches/">Tijorat banklarining filiallari</a>
                                </li>
                                <li>
                                  <a href="/uz/credit-organizations/banks/atm/">Bankomatlar</a>
                                </li>
                                <li>
                                  <a href="/uz/credit-organizations/banks/exchange-offices/">Ayirboshlash
                                    shoxobchalari</a>
                                </li>
                                <li>
                                  <a href="/uz/credit-organizations/banks/rating-scores/">Reyting baholari</a>
                                </li>
                              </ul>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/credit-organizations/microcredit/">Mikromoliya tashkilotlari</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/credit-organizations/pawn-shops/">Lombardlar</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/credit-organizations/offices-foreign-banks/">Chet el banklari
                                  vakolatxonalari</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/credit-organizations/licensing/">Litsenziyalash tartibi</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/credit-organizations/auditors/">Auditorlik tekshiruvini o'tkazish malaka
                                  sertifikatiga ega auditorlar ro'yxati</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="nav_dropdown">
                    <a href="/uz/statistics/" class="dropnav_toggle">Statistika</a>
                    <div class="subnav">
                      <div class="subnav__group subnav__group_01 active">
                        <div class="subnav__container">
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/statistics/dks/">Pul-kredit va moliyaviy statistika</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/statistics/bankstats/">Bank tizimi faoliyati ko‘rsatkichlari</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/statistics/credit/">Nobank kredit tashkilotlarining
                                  ko‘rsatkichlari</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/statistics/paysistem/">To‘lov tizimining ko‘rsatkichlari</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/statistics/intlreserves/">O’zbekiston Respublikasining xalqaro
                                  zaxiralari</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/statistics/bop/">O‘zbekiston Respublikasi to‘lov balansi,
                                  xalqaro investitsiyaviy mavqei va tashqi
                                  qarzi</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/statistics/financing/">Tijorat banklari tomonidan investitsion
                                  loyihalarni moliyalashtirish</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/statistics/buleten/">Markaziy bankning statistik byulleteni</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/statistics/e-gdds/data/">Kengaytirilgan Ma’lumotlarni tarqatishning
                                  umumiy tizimi (k-MTUT)</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/statistics/calendar-statistical-data/">Rasmiy veb-saytda statistik
                                  ma'lumotlarni
                                  e'lon qilish taqvimi</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/statistics/calendar/">k-MTUT doirasida ma’lumotlarni e’lon qilish
                                  taqvimi</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="nav_dropdown">
                    <a href="/uz/documents/" class="dropnav_toggle">Bank qonunchiligi</a>
                    <div class="subnav">
                      <div class="subnav__group subnav__group_01 active">
                        <div class="subnav__container">
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/documents/3327/">Qonunlar</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/documents/3328/">Prezident farmonlari</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/documents/3329/">Prezident qarorlari</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/documents/3330/">Vazirlar Mahkamasi qarorlari</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/documents/3331/">Me’yoriy hujjatlar</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/documents/3332/">Me’yoriy hujjatlarga sharhlar</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/documents/3333/">Bank xodimining kasb odob-ahloqi kodeksi</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/documents/3343/">Tadbirkorlik faoliyatiga aralashmaslik</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/documents/4658/">Tartibga solish ta’sirini baholash</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/documents/izmenyonnie-dokumenti/">O‘z kuchini yo‘qotgan normativ
                                  hujjatlar</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/documents/list-projects-normative/">Me’yoriy hujjatlar loyihalarini
                                  muhokama
                                  etish</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="nav_dropdown">
                    <a href="/uz/press_center/" class="dropnav_toggle">Matbuot markazi</a>
                    <div class="subnav">
                      <div class="subnav__group subnav__group_01 active">
                        <div class="subnav__container">
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/press_center/news/">Yangiliklar</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/press_center/reviews/">Sharhlar</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/press_center/releases/">Press-relizlar</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/press_center/adverts/">E’lonlar va tenderlar</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/press_center/reports/">Ma’ruza va nutqlar</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/press_center/presentations/">Prezentatsiyalar</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/press_center/calendar-publications/">Publikatsiyalar va matbuot anjumanlari
                                  taqvimi</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/press_center/online/">Onlayn translyatsiya</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/press_center/media_library/">Media kutubxona</a>
                              </div>
                              <ul class="subnav__menu">
                                <li>
                                  <a href="/uz/press_center/media_library/photo_gallery/">Fotogalereya</a>
                                </li>
                                <li>
                                  <a href="/uz/press_center/media_library/video/">Video</a>
                                </li>
                              </ul>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/press_center/press-service/">Matbuot xizmati</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/press_center/expert-explanation/">Ekspert izohi</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/press_center/articles-and-interviews/">Maqola va intervyular</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/press_center/question_answer/">Ko‘p beriladigan savollar</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/press_center/media-plan/">Media reja</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="nav_dropdown">
                    <a href="/uz/services/open_data/" class="dropnav_toggle">Ochiq ma’lumotlar</a>
                    <div class="subnav">
                      <div class="subnav__group subnav__group_01 active">
                        <div class="subnav__container">
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/services/open_data/portal/">Ochiq ma'lumotlar portalidan olingan
                                  ma'lumotlar ro'yxati</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/services/open_data/information/">PF-6247 boʼyicha ochiq maʼlumotlar</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/services/open_data/openness-rates/">Markaziy bank faoliyatining ochiqligi
                                  ko‘rsatkichlari</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="nav_dropdown">
                    <a href="/uz/publications/" class="dropnav_toggle">Nashrlar</a>
                    <div class="subnav">
                      <div class="subnav__group subnav__group_01 active">
                        <div class="subnav__container">
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/publications/annual-report/">Markaziy bankning yillik hisoboti</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/statistics/buleten/">Markaziy bankning statistik byulleteni</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/publications/survey-results/">Iqtisodiyotning real sektoridagi holat va
                                  kutilmalarni o‘rganish natijalari</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/publications/balance-of-payments/">O‘zbekiston Respublikasi to‘lov balansi,
                                  xalqaro investitsiyaviy mavqei va tashqi
                                  qarzi</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="nav_dropdown">
                    <a href="/uz/services/" class="dropnav_toggle">Interaktiv xizmatlar</a>
                    <div class="subnav">
                      <div class="subnav__group subnav__group_01 active">
                        <div class="subnav__container">
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/services/online-application/">Onlayn shakldagi arizalar</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="https://pm.gov.uz/ru#/authorities/13/9223/_apply" target="_blank">Bank Boshqaruvi Raisining
                                  Virtual
                                  qabulxonasi</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/services/government/">Davlat xizmatlari</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/services/regulations/">Davlat xizmatlarini ko‘rsatish
                                  reglamenti</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/services/results-of-applications/">Davlat xizmati bo'yicha murojaatning
                                  holati
                                  va natijasi</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/services/useful-links/">Foydali havolalar</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/services/votes/">So‘rovnomalar</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/services/survey/">Anketa-so‘rovnoma</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/services/request-information/">Axborot olish uchun so‘rovlar</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/arkhiv-kursov-valyut/informer-kursa-valyut/">Valyutalar kurslari
                                  informeri</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/arkhiv-kursov-valyut/reference/">Valyutalar kurslari haqida
                                  ma’lumotnoma</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/services/open_data/">Ochiq ma’lumotlar</a>
                              </div>
                              <ul class="subnav__menu">
                                <li>
                                  <a href="/uz/services/open_data/portal/">Ochiq ma'lumotlar portalidan olingan
                                    ma'lumotlar ro'yxati</a>
                                </li>
                                <li>
                                  <a href="/uz/services/open_data/information/">PF-6247 boʼyicha ochiq maʼlumotlar</a>
                                </li>
                                <li>
                                  <a href="/uz/services/open_data/openness-rates/">Markaziy bank faoliyatining ochiqligi
                                    ko‘rsatkichlari</a>
                                </li>
                              </ul>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/services/citizens/">Jismoniy va yuridik shaxslarning
                                  murojaatlari</a>
                              </div>
                              <ul class="subnav__menu">
                                <li>
                                  <a href="/uz/services/citizens/procedure/">Murojaatlarni ko‘rib chiqish tartibi</a>
                                </li>
                                <li>
                                  <a href="/uz/services/citizens/law/">“Jismoniy va yuridik shaxslarning
                                    murojaatlari to’g’risiga”gi Qonun</a>
                                </li>
                                <li>
                                  <a href="/uz/services/citizens/send/">Murojaatni yuborish</a>
                                </li>
                                <li>
                                  <a href="https://murojaat.gov.uz" target="_blank">Murojaatlar bilan ishlash yagona onlayn
                                    platformasi</a>
                                </li>
                                <li>
                                  <a href="/uz/services/citizens/status/">Arizaning maqomini tekshirish</a>
                                </li>
                                <li>
                                  <a href="/uz/services/citizens/schedule-reception/">Fuqarolarni qabul qilish
                                    grafigi</a>
                                </li>
                                <li>
                                  <a href="/uz/services/citizens/statistics/">Murojaatlar statistikasi</a>
                                </li>
                                <li>
                                  <a href="/uz/services/citizens/request-for-information/">Axborot olish uchun so‘rovlar
                                    statistikasi</a>
                                </li>
                                <li>
                                  <a href="/uz/services/citizens/helpline-commercial-banks/">Tijorat banklarining
                                    ishonch
                                    telefonlari</a>
                                </li>
                                <li>
                                  <a href="/uz/services/citizens/helpline/">Ishonch telefoni</a>
                                </li>
                              </ul>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/services/task-execution-states/">Ijro intizomi</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="nav_dropdown">
                    <a href="/uz/arkhiv-kursov-valyut/" class="dropnav_toggle">Valyutalar kurslari arxivi</a>
                    <div class="subnav">
                      <div class="subnav__group subnav__group_01 active">
                        <div class="subnav__container">
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/arkhiv-kursov-valyut/index.php">Valyutalar kurslari arxivi</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/arkhiv-kursov-valyut/dinamika-kursov-valyut/">Valyutalar kurslari
                                  dinamikasi</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/arkhiv-kursov-valyut/informer-kursa-valyut/">Valyutalar kurslari
                                  informeri</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/arkhiv-kursov-valyut/reference/">Valyutalar kurslari haqida
                                  ma’lumotnoma</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/arkhiv-kursov-valyut/veb-masteram/">Dasturchilarga</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="https://cbu.uz/uz/arkhiv-kursov-valyut/xml/" target="_blank">XML formatida</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="https://cbu.uz/uz/services/open_data/rates/csv/" target="_blank">CSV formatida</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="https://cbu.uz/uz/arkhiv-kursov-valyut/json/" target="_blank">JSON formatida</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="nav_dropdown">
                    <a href="/uz/banknotes-coins/" class="dropnav_toggle">Banknotalar, Tangalar va Oltin quymalar</a>
                    <div class="subnav">
                      <div class="subnav__group subnav__group_01 active">
                        <div class="subnav__container">
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/banknotes-coins/banknotes/">Banknotlar</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/banknotes-coins/coins/">Tangalar</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/banknotes-coins/commemorative-coins/">Esdalik tangalari</a>
                              </div>
                              <ul class="subnav__menu">
                                <li>
                                  <a href="/uz/banknotes-coins/commemorative-coins/information/">Markaziy bank esdalik
                                    tangalari
                                    to'g'risida ma'lumot</a>
                                </li>
                                <li>
                                  <a href="/uz/banknotes-coins/commemorative-coins/catalog/">Sotuvga chiqarilayotgan
                                    esdalik
                                    tangalari</a>
                                </li>
                                <li>
                                  <a href="/uz/banknotes-coins/commemorative-coins/price/">Esdalik tangalarining sotuv
                                    narxlari</a>
                                </li>
                                <li>
                                  <a href="/uz/banknotes-coins/commemorative-coins/points-sale/">Esdalik tangalarining
                                    sotish va qayta
                                    xarid qilish shoxobchalari</a>
                                </li>
                                <li>
                                  <a href="/uz/banknotes-coins/commemorative-coins/balance/">Esdalik tangalarining
                                    qoldig‘i bo‘yicha
                                    ma’lumot</a>
                                </li>
                                <li>
                                  <a href="/uz/banknotes-coins/commemorative-coins/storage/">Esdalik tangalarini saqlash
                                    bo‘yicha
                                    tavsiyalar</a>
                                </li>
                              </ul>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/banknotes-coins/gold-bars/">Oltin quymalar</a>
                              </div>
                              <ul class="subnav__menu">
                                <li>
                                  <a href="/uz/banknotes-coins/gold-bars/info/">Oʻlchovli oltin quymalar toʻgʻrisidagi
                                    maʼlumot</a>
                                </li>
                                <li>
                                  <a href="/uz/banknotes-coins/gold-bars/list/">Oʻlchovli oltin quymalar va ularning
                                    maxsus himoya qadoqlari namunalari</a>
                                </li>
                                <li>
                                  <a href="/uz/banknotes-coins/gold-bars/prices/">O‘lchovli oltin quymalarni sotish va
                                    qaytarib sotib olish narxlari</a>
                                </li>
                                <li>
                                  <a href="/uz/banknotes-coins/gold-bars/sale-and-buy-back-offices/">Oʻlchovli oltin
                                    quymalarning sotish va
                                    qaytarib sotib olish shoxobchalari</a>
                                </li>
                                <li>
                                  <a href="/uz/banknotes-coins/gold-bars/balance/">O'lchovli oltin quymalar qoldig'i
                                    bo'yicha ma'lumot</a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="nav_dropdown">
                    <a href="/uz/egovernment/" class="dropnav_toggle">Elektron hukumat</a>
                    <div class="subnav">
                      <div class="subnav__group subnav__group_01 active">
                        <div class="subnav__container">
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/egovernment/role/">Markaziy bankning “Elektron hukumat”
                                  tizimida qatnashishda tutgan o‘rni va
                                  roli</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/egovernment/events/">“Elektron hukumat” tizimi tarkibida amalga
                                  oshiriladigan chora-tadbirlar</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/egovernment/bpr/">Davlat xizmatlarini ko‘rsatish tartibini
                                  takomillashtirish bo‘yicha sharh</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="">
                    <a href="/uz/other-resources/">Boshqa manbalar</a>
                  </li>
                  <li class="">
                    <a href="/uz/government-programs/">Davlat dasturlari</a>
                  </li>
                  <li class="nav_dropdown">
                    <a href="/uz/consumer-protection/" class="dropnav_toggle">Bank xizmatlari iste’molchilarining
                      huquqlarini himoya
                      qilish</a>
                    <div class="subnav">
                      <div class="subnav__group subnav__group_01 active">
                        <div class="subnav__container">
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/consumer-protection/reminder-of-consumer-banking-services/">Bank xizmatlari
                                  iste’molchilariga
                                  eslatma</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="nav_dropdown">
                    <a href="/uz/anti-corruption/" class="dropnav_toggle">Korrupsiyaga qarshi kurashish</a>
                    <div class="subnav">
                      <div class="subnav__group subnav__group_01 active">
                        <div class="subnav__container">
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/anti-corruption/documents/">O‘zbekiston Respublikasi Markaziy bankining
                                  Korrupsiyaga qarshi kurashish bo‘yicha ichki
                                  me’yoriy hujjatlari</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/anti-corruption/send/">Markaziy bank xodimlarining korruptsion
                                  hatti-harakatlariga oid xabarlarni
                                  yuborish</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/anti-corruption/events/">Tadbirlar</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/anti-corruption/communication-channels/">Aloqa kanallari</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/anti-corruption/handouts/">Targ‘ibot materiallari</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/anti-corruption/articles/">Maqolalar</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/anti-corruption/presentations/">Taqdimotlar</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="nav_dropdown">
                    <a href="/uz/cert/" class="dropnav_toggle">CERT-CBU kiberxavfsizlik markazi</a>
                    <div class="subnav">
                      <div class="subnav__group subnav__group_01 active">
                        <div class="subnav__container">
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/cert/about/">Markaziy bank “CERT-CBU” kiberxavfsizlik
                                  markazi haqida</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="nav_dropdown">
                    <a href="/uz/combating-money-laundering/" class="dropnav_toggle">Jinoiy faoliyatdan olingan
                      daromadlarni
                      legallashtirishga, terrorizmni moliyalashtirishga va
                      ommaviy qirgʻin qurolini tarqatishni moliyalashtirishga
                      qarshi kurashish</a>
                    <div class="subnav">
                      <div class="subnav__group subnav__group_01 active">
                        <div class="subnav__container">
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/combating-money-laundering/news/">Oxirgi yangiliklar va xabarlar</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/combating-money-laundering/aml-cft/">JFODL/TMQK nazorati yoki MBning
                                  JFODL/TMQK
                                  nazorati sohasidagi vazifalari va
                                  funksiyalari</a>
                              </div>
                              <ul class="subnav__menu">
                                <li>
                                  <a href="/uz/combating-money-laundering/aml-cft/about/">Jinoiy faoliyatdan olingan
                                    daromadlarni
                                    legallashtirishga, terrorizmni
                                    moliyalashtirishga va ommaviy qirgʻin
                                    qurolini tarqatishni moliyalashtirishga
                                    qarshi kurashish sohasi haqida</a>
                                </li>
                                <li>
                                  <a href="/uz/combating-money-laundering/aml-cft/international-standards/">Xalqaro
                                    standartlar va FATFning roli</a>
                                </li>
                                <li>
                                  <a href="/uz/combating-money-laundering/aml-cft/united-nations/">BMTning roli va
                                    Xavfsizlik Kengashi
                                    rezolyutsiyalari</a>
                                </li>
                                <li>
                                  <a href="/uz/combating-money-laundering/aml-cft/national-system/">Oʻzbekiston
                                    Respublikasidagi milliy
                                    JFODL/TM/OQQTMQK tizimi</a>
                                </li>
                                <li>
                                  <a href="/uz/combating-money-laundering/aml-cft/eag/">EAG va O‘zbekistonning o‘zaro
                                    baholashi</a>
                                </li>
                              </ul>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/combating-money-laundering/resources/">Qo‘llanma va resurslar</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/combating-money-laundering/legislation/">Qonunchilik</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/combating-money-laundering/glossary/">Izohli lug'at</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="nav_dropdown menu-else menu-else-hidden dropdown-reverse">
                    <a href="#" class="dropnav_toggle">...</a>
                    <div class="subnav">
                      <div class="subnav__group subnav__group_01 active">
                        <div class="subnav__container">
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/about/">Bank haqida</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/monetary-policy/">Pul-kredit siyosati</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/financial-stability/">Moliyaviy bаrqаrоrlik</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/research/">Tadqiqotlar</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/payment-systems/">To‘lov tizimlari</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/credit-organizations/">Kredit tashkilotlari</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/statistics/">Statistika</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/documents/">Bank qonunchiligi</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/press_center/">Matbuot markazi</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/services/open_data/">Ochiq ma’lumotlar</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/publications/">Nashrlar</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/services/">Interaktiv xizmatlar</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/arkhiv-kursov-valyut/">Valyutalar kurslari arxivi</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/banknotes-coins/">Banknotalar, Tangalar va Oltin quymalar</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/egovernment/">Elektron hukumat</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/other-resources/">Boshqa manbalar</a>
                              </div>
                            </div>
                          </div>
                          <div class="subnav__col">
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/government-programs/">Davlat dasturlari</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/consumer-protection/">Bank xizmatlari iste’molchilarining
                                  huquqlarini himoya qilish</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/anti-corruption/">Korrupsiyaga qarshi kurashish</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/cert/">CERT-CBU kiberxavfsizlik markazi</a>
                              </div>
                            </div>
                            <div class="subnav__item">
                              <div class="subnav__title">
                                <a href="/uz/combating-money-laundering/">Jinoiy faoliyatdan olingan daromadlarni
                                  legallashtirishga, terrorizmni
                                  moliyalashtirishga va ommaviy qirgʻin
                                  qurolini tarqatishni moliyalashtirishga
                                  qarshi kurashish</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
                <div class="header_search">
                  <div class="header_search__button">
                    <i>
                      <svg class="ico_svg" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__search" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                      </svg>
                    </i>
                  </div>

                  <div class="header_search__input">
                    <form action="/uz/search/index.php">
                      <input class="form-control" type="text" name="q" maxlength="50" placeholder="Saytdan qidiruv..." autocomplete="off">
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>
      <div class="navigation">
        <div class="navigation__scroll mCustomScrollbar _mCS_1"><div id="mCSB_1" class="mCustomScrollBox mCS-dark mCSB_vertical mCSB_inside" style="max-height: none;" tabindex="0"><div id="mCSB_1_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="ltr">
          <div class="container">
            <div class="navigation__header">
              <div class="navigation__header_logo">
                <img src="/bitrix/templates/main/img/logo-uz.svg" class="img_fluid mCS_img_loaded" alt="">
              </div>

              <a href="#" class="navigation__header_close nav_toggle"></a>
              <div class="navigation__header_search">
                <div class="header_search">
                  <div class="header_search__button">
                    <i>
                      <svg class="ico_svg" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__search" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                      </svg>
                    </i>
                  </div>
                  <div class="header_search__input">
                    <form action="/uz/search/index.php">
                      <input class="form-control" type="text" name="q" maxlength="50" placeholder="Saytdan qidiruv..." autocomplete="off">
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="navigation__top">
              <div class="navigation__top_lng">
                <a class="navigation__top_lng_item active" href="/uz/about/international-cooperation/" data-lang="uz">O‘zbekcha</a>
                <a class="navigation__top_lng_item" href="/oz/about/international-cooperation/" data-lang="oz">Ўзбекча</a>
                <a class="navigation__top_lng_item" href="/ru/about/international-cooperation/" data-lang="ru">На
                  русском</a>
                <a class="navigation__top_lng_item" href="/en/about/international-cooperation/" data-lang="en">In
                  english</a>
              </div>
              <div class="navigation__top_auth">
                <div class="navigation__mobile_auth__wrap">
                  <div id="auth-form" class="bx-system-auth-form ym-hide-content">
                    <div class="header_auth">
                      <div class="header_auth__label">
                        <div class="header_auth__label_text">
                          Kirish yoki ro‘yxatdan o‘tish
                        </div>
                        <div class="header_auth__label_avatar">
                          <i>
                            <svg class="ico_svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                              <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__user" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                            </svg>
                          </i>
                        </div>
                        <div class="header_auth__label_arrow">
                          <svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                            <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                          </svg>
                        </div>
                      </div>
                      <div class="header_auth__content">
                        <div class="header_auth__form">
                          <div class="header_auth__title">
                            <i>
                              <svg class="ico_svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__user" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                              </svg>
                            </i>
                            <span>Saytga kirish</span>
                          </div>
                          <form class="form" name="system_auth_formPqgS8z" method="post" target="_top" action="/uz/about/international-cooperation/74848/?login=yes">
                            <input type="hidden" name="backurl" value="/uz/about/international-cooperation/74848/">
                            <input type="hidden" name="AUTH_FORM" value="Y">
                            <input type="hidden" name="TYPE" value="AUTH">

                            <div class="form-group">
                              <input type="text" class="form-control ym-disable-keys" placeholder="Login" name="USER_LOGIN" maxlength="50" value="" size="17">
                            </div>
                            <div class="form-group">
                              <input type="password" name="USER_PASSWORD" maxlength="50" size="17" class="form-control ym-disable-keys" placeholder="Parol">
                              <i class="pass_view">
                                <svg class="ico_svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                  <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__help_circle" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                                </svg>
                              </i>
                            </div>
                            <div class="form-group">
                              <label for="USER_REMEMBER_frm_8k8aZSY" class="form_checkbox" title="Yodda saqlamoq meni shuning bilan kompyuterda">
                                <input type="checkbox" id="USER_REMEMBER_frm_8k8aZSY" name="USER_REMEMBER" value="Y">
                                <span>Meni saqlab qolish</span>
                              </label>
                            </div>
                            <div class="form-group">
                              <input type="submit" class="btn btn-primary btn-sm text-uppercase" name="Login" value="Kirmoq">
                            </div>
                            <div class="text-center">
                              <noindex><a href="/uz/auth/?register=yes&amp;backurl=%2Fuz%2Fabout%2Finternational-cooperation%2F74848%2F" class="header_auth__reg">
                                  <span>Registratsiya</span>
                                  <i class="base">
                                    <svg class="ico_svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                      <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__help_circle" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                                    </svg>
                                  </i>
                                  <i class="hover">
                                    <svg class="ico_svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                      <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__arrow_right" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                                    </svg>
                                  </i> </a></noindex>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="navigation__main">
              <div class="navigation__main_two">
                <ul class="navigation__primary">
                  <li>
                    <a href="/uz/about/" class="drop_nav"><span>Bank haqida</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                          <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                        </svg></i></a><a href="/uz/about/" class="navigation__primary_title nav_desktop"><span>Bank
                        haqida</span></a>
                    <ul class="navigation__second">
                      <li>
                        <a href="/uz/about/functions/"><span>Huquqiy maqom, maqsadlar, vazifalar, qadriyatlar
                            va missiya</span></a>
                      </li>
                      <li>
                        <a href="/uz/about/history/"><span>Bank tizimi tarixi</span></a>
                      </li>
                      <li>
                        <a href="/uz/about/management/"><span>Boshqaruv</span></a>
                      </li>
                      <li>
                        <a href="/uz/about/executive-directors/"><span>Bosh direktorlar</span></a>
                      </li>
                      <li>
                        <a href="/uz/about/advisors/"><span>Maslahatchilar</span></a>
                      </li>
                      <li>
                        <a href="/uz/about/central-office/" class="drop_nav"><span>Bank strukturasi</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                              <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                            </svg></i></a>
                        <ul class="navigation__third">
                          <li>
                            <a href="/uz/about/central-office/divisions/"><span>Tarkibiy bo‘linmalar</span></a>
                          </li>
                          <li>
                            <a href="/uz/about/central-office/regional/"><span>Hududiy Bosh boshqarmalar</span></a>
                          </li>
                          <li>
                            <a href="/uz/about/central-office/subordinate/"><span>Tasarrufdagi tashkilotlar</span></a>
                          </li>
                        </ul>
                      </li>
                      <li>
                        <a href="/uz/about/international-cooperation/"><span>Xalqaro hamkorlik</span></a>
                      </li>
                      <li>
                        <a href="/uz/about/cooperation-organizations/"><span>Hukumat va jamoat tashkilotlari bilan
                            hamkorlik</span></a>
                      </li>
                      <li>
                        <a href="/uz/about/vacancies/" class="drop_nav"><span>Karyera</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                              <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                            </svg></i></a>
                        <ul class="navigation__third">
                          <li>
                            <a href="/uz/about/vacancies/personnel-policy/"><span>Kadrlar siyosati</span></a>
                          </li>
                          <li>
                            <a href="/uz/about/vacancies/list/"><span>Bo‘sh ish o‘rinlari</span></a>
                          </li>
                          <li>
                            <a href="/uz/about/vacancies/youth-union/"><span>O‘zbekiston Respublikasi Markaziy banki
                                Yoshlar yetakchilari kengashi</span></a>
                          </li>
                          <li>
                            <a href="/uz/about/vacancies/scholarship/"><span>Markaziy bank stipendiyasi</span></a>
                          </li>
                        </ul>
                      </li>
                      <li>
                        <a href="/uz/about/gender/" class="drop_nav"><span>Gender tenglik masalalari</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                              <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                            </svg></i></a>
                        <ul class="navigation__third">
                          <li>
                            <a href="/uz/about/gender/events/"><span>Tadbirlar</span></a>
                          </li>
                          <li>
                            <a href="/uz/about/gender/comission-members/"><span>Maslahat kengashi</span></a>
                          </li>
                          <li>
                            <a href="/uz/about/gender/documents/"><span>Hujjatlar</span></a>
                          </li>
                        </ul>
                      </li>
                      <li>
                        <a href="/uz/about/public-council/" class="drop_nav"><span>Jamoatchilik kengashi</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                              <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                            </svg></i></a>
                        <ul class="navigation__third">
                          <li>
                            <a href="/uz/about/public-council/events/"><span>Tadbirlar</span></a>
                          </li>
                          <li>
                            <a href="/uz/about/public-council/council-members/"><span>Kengash aʼzolari</span></a>
                          </li>
                          <li>
                            <a href="/uz/about/public-council/documents/"><span>Xujjatlar</span></a>
                          </li>
                        </ul>
                      </li>
                      <li>
                        <a href="/uz/about/open-activity/" class="drop_nav"><span>Faoliyat ochiqligi</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                              <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                            </svg></i></a>
                        <ul class="navigation__third">
                          <li>
                            <a href="/uz/about/open-activity/public-procurement/"><span>Davlat xaridlari toʼgʼrisida
                                maʼlumot</span></a>
                          </li>
                          <li>
                            <a href="/uz/about/open-activity/work-plan/"><span>Ish reja</span></a>
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <li>
                    <a href="/uz/press_center/" class="drop_nav"><span>Matbuot markazi</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                          <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                        </svg></i></a><a href="/uz/press_center/" class="navigation__primary_title nav_desktop"><span>Matbuot markazi</span></a>
                    <ul class="navigation__second">
                      <li>
                        <a href="/uz/press_center/news/"><span>Yangiliklar</span></a>
                      </li>
                      <li>
                        <a href="/uz/press_center/reviews/"><span>Sharhlar</span></a>
                      </li>
                      <li>
                        <a href="/uz/press_center/releases/"><span>Press-relizlar</span></a>
                      </li>
                      <li>
                        <a href="/uz/press_center/adverts/"><span>E’lonlar va tenderlar</span></a>
                      </li>
                      <li>
                        <a href="/uz/press_center/reports/"><span>Ma’ruza va nutqlar</span></a>
                      </li>
                      <li>
                        <a href="/uz/press_center/presentations/"><span>Prezentatsiyalar</span></a>
                      </li>
                      <li>
                        <a href="/uz/press_center/calendar-publications/"><span>Publikatsiyalar va matbuot anjumanlari
                            taqvimi</span></a>
                      </li>
                      <li>
                        <a href="/uz/press_center/online/"><span>Onlayn translyatsiya</span></a>
                      </li>
                      <li>
                        <a href="/uz/press_center/media_library/" class="drop_nav"><span>Media kutubxona</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                              <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                            </svg></i></a>
                        <ul class="navigation__third">
                          <li>
                            <a href="/uz/press_center/media_library/photo_gallery/"><span>Fotogalereya</span></a>
                          </li>
                          <li>
                            <a href="/uz/press_center/media_library/video/"><span>Video</span></a>
                          </li>
                        </ul>
                      </li>
                      <li>
                        <a href="/uz/press_center/press-service/"><span>Matbuot xizmati</span></a>
                      </li>
                      <li>
                        <a href="/uz/press_center/expert-explanation/"><span>Ekspert izohi</span></a>
                      </li>
                      <li>
                        <a href="/uz/press_center/articles-and-interviews/"><span>Maqola va intervyular</span></a>
                      </li>
                      <li>
                        <a href="/uz/press_center/question_answer/"><span>Ko‘p beriladigan savollar</span></a>
                      </li>
                      <li>
                        <a href="/uz/press_center/media-plan/"><span>Media reja</span></a>
                      </li>
                    </ul>
                  </li>
                  <li>
                    <a href="/uz/services/" class="drop_nav"><span>Interaktiv xizmatlar</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                          <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                        </svg></i></a><a href="/uz/services/" class="navigation__primary_title nav_desktop"><span>Interaktiv xizmatlar</span></a>
                    <ul class="navigation__second">
                      <li>
                        <a href="/uz/services/online-application/"><span>Onlayn shakldagi arizalar</span></a>
                      </li>
                      <li>
                        <a href="https://pm.gov.uz/ru#/authorities/13/9223/_apply" target="_blank"><span>Bank Boshqaruvi Raisining
                            Virtual
                            qabulxonasi</span></a>
                      </li>
                      <li>
                        <a href="/uz/services/government/"><span>Davlat xizmatlari</span></a>
                      </li>
                      <li>
                        <a href="/uz/services/regulations/"><span>Davlat xizmatlarini ko‘rsatish reglamenti</span></a>
                      </li>
                      <li>
                        <a href="/uz/services/results-of-applications/"><span>Davlat xizmati bo'yicha murojaatning
                            holati va
                            natijasi</span></a>
                      </li>
                      <li>
                        <a href="/uz/services/useful-links/"><span>Foydali havolalar</span></a>
                      </li>
                      <li>
                        <a href="/uz/services/votes/"><span>So‘rovnomalar</span></a>
                      </li>
                      <li>
                        <a href="/uz/services/survey/"><span>Anketa-so‘rovnoma</span></a>
                      </li>
                      <li>
                        <a href="/uz/services/request-information/"><span>Axborot olish uchun so‘rovlar</span></a>
                      </li>
                      <li>
                        <a href="/uz/arkhiv-kursov-valyut/informer-kursa-valyut/"><span>Valyutalar kurslari
                            informeri</span></a>
                      </li>
                      <li>
                        <a href="/uz/arkhiv-kursov-valyut/reference/"><span>Valyutalar kurslari haqida
                            ma’lumotnoma</span></a>
                      </li>
                      <li>
                        <a href="/uz/services/open_data/" class="drop_nav"><span>Ochiq ma’lumotlar</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                              <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                            </svg></i></a>
                        <ul class="navigation__third">
                          <li>
                            <a href="/uz/services/open_data/portal/"><span>Ochiq ma'lumotlar portalidan olingan
                                ma'lumotlar ro'yxati</span></a>
                          </li>
                          <li>
                            <a href="/uz/services/open_data/information/"><span>PF-6247 boʼyicha ochiq
                                maʼlumotlar</span></a>
                          </li>
                          <li>
                            <a href="/uz/services/open_data/openness-rates/"><span>Markaziy bank faoliyatining ochiqligi
                                ko‘rsatkichlari</span></a>
                          </li>
                        </ul>
                      </li>
                      <li>
                        <a href="/uz/services/citizens/" class="drop_nav"><span>Jismoniy va yuridik shaxslarning
                            murojaatlari</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                              <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                            </svg></i></a>
                        <ul class="navigation__third">
                          <li>
                            <a href="/uz/services/citizens/procedure/"><span>Murojaatlarni ko‘rib chiqish
                                tartibi</span></a>
                          </li>
                          <li>
                            <a href="/uz/services/citizens/law/"><span>“Jismoniy va yuridik shaxslarning
                                murojaatlari to’g’risiga”gi Qonun</span></a>
                          </li>
                          <li>
                            <a href="/uz/services/citizens/send/"><span>Murojaatni yuborish</span></a>
                          </li>
                          <li>
                            <a href="https://murojaat.gov.uz" target="_blank"><span>Murojaatlar bilan ishlash yagona onlayn
                                platformasi</span></a>
                          </li>
                          <li>
                            <a href="/uz/services/citizens/status/"><span>Arizaning maqomini tekshirish</span></a>
                          </li>
                          <li>
                            <a href="/uz/services/citizens/schedule-reception/"><span>Fuqarolarni qabul qilish
                                grafigi</span></a>
                          </li>
                          <li>
                            <a href="/uz/services/citizens/statistics/"><span>Murojaatlar statistikasi</span></a>
                          </li>
                          <li>
                            <a href="/uz/services/citizens/request-for-information/"><span>Axborot olish uchun so‘rovlar
                                statistikasi</span></a>
                          </li>
                          <li>
                            <a href="/uz/services/citizens/helpline-commercial-banks/"><span>Tijorat banklarining
                                ishonch
                                telefonlari</span></a>
                          </li>
                          <li>
                            <a href="/uz/services/citizens/helpline/"><span>Ishonch telefoni</span></a>
                          </li>
                        </ul>
                      </li>
                      <li>
                        <a href="/uz/services/task-execution-states/"><span>Ijro intizomi</span></a>
                      </li>
                    </ul>
                  </li>
                  <li>
                    <a href="/uz/contacts/" class="drop_nav"><span>Bog‘lanish</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                          <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                        </svg></i></a><a href="/uz/contacts/" class="navigation__primary_title nav_desktop"><span>Bog‘lanish</span></a>
                    <ul class="navigation__second">
                      <li>
                        <a href="/uz/contacts/"><span>Bog‘lanish</span></a>
                      </li>
                      <li>
                        <a href="/uz/contacts/helpline/"><span>Aloqa telefon raqami</span></a>
                      </li>
                      <li>
                        <a href="/uz/contacts/requisites/"><span>Rekvizitlar</span></a>
                      </li>
                    </ul>
                  </li>
                  <li>
                    <a href="/uz/subscribe/"><span>Obuna</span></a>
                  </li>
                  <li>
                    <a href="/uz/monetary-policy/" class="drop_nav"><span>Pul-kredit siyosati</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                          <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                        </svg></i></a><a href="/uz/monetary-policy/" class="navigation__primary_title nav_desktop"><span>Pul-kredit siyosati</span></a>
                    <ul class="navigation__second">
                      <li>
                        <a href="/uz/monetary-policy/concept/"><span>Pul-kredit siyosati maqsadi va
                            tamoyillari</span></a>
                      </li>
                      <li>
                        <a href="/uz/monetary-policy/refinancing-rate/" class="drop_nav"><span>Asosiy
                            stavka</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                              <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                            </svg></i></a>
                        <ul class="navigation__third">
                          <li>
                            <a href="/uz/monetary-policy/refinancing-rate/schedule-of-meetings/"><span>Asosiy stavkani
                                ko‘rib chiqish bo‘yicha
                                Boshqaruv yig‘ilishlari taqvimi</span></a>
                          </li>
                        </ul>
                      </li>
                      <li>
                        <a href="/uz/monetary-policy/money-market-operations/" class="drop_nav"><span>Pul bozoridagi
                            operatsiyalar</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                              <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                            </svg></i></a>
                        <ul class="navigation__third">
                          <li>
                            <a href="/uz/monetary-policy/money-market-operations/interbank-money-market/"><span>Banklararo
                                pul bozori</span></a>
                          </li>
                          <li>
                            <a href="/uz/monetary-policy/money-market-operations/interbank-repo-market/"><span>Banklararo
                                REPO bozori</span></a>
                          </li>
                          <li>
                            <a href="/uz/monetary-policy/money-market-operations/aggregate-liquidity/"><span>Bank tizimi
                                umumiy likvidligi</span></a>
                          </li>
                          <li>
                            <a href="/uz/monetary-policy/money-market-operations/uzonia/"><span>UZONIA</span></a>
                          </li>
                        </ul>
                      </li>
                      <li>
                        <a href="/uz/monetary-policy/publications/" class="drop_nav"><span>Pul-kredit siyosati
                            nashrlari</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                              <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                            </svg></i></a>
                        <ul class="navigation__third">
                          <li>
                            <a href="/uz/monetary-policy/publications/press-releases/"><span>Press-relizlar</span></a>
                          </li>
                          <li>
                            <a href="/uz/monetary-policy/publications/reviews/"><span>Pul-kredit siyosati
                                sharhlari</span></a>
                          </li>
                          <li>
                            <a href="/uz/monetary-policy/publications/trend/"><span>Pul-kredit siyosatining asosiy
                                yo’nalishlari</span></a>
                          </li>
                          <li>
                            <a href="/uz/monetary-policy/publications/money-market/"><span>Pul bozori va likvidlik
                                sharhi</span></a>
                          </li>
                        </ul>
                      </li>
                      <li>
                        <a href="/uz/monetary-policy/operations/" class="drop_nav"><span>Pul-kredit siyosati asosiy
                            operatsiyalari</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                              <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                            </svg></i></a>
                        <ul class="navigation__third">
                          <li>
                            <a href="/uz/monetary-policy/operations/about/"><span>Pul-kredit operatsiyalari
                                nima?</span></a>
                          </li>
                          <li>
                            <a href="/uz/monetary-policy/operations/absorb-liquidity/"><span>Likvidlilik olish bo‘yicha
                                operatsiyalar</span></a>
                          </li>
                          <li>
                            <a href="/uz/monetary-policy/operations/provide-liquidity/"><span>Likvidlilik taqdim etish
                                bo‘yicha
                                operatsiyalar</span></a>
                          </li>
                          <li>
                            <a href="/uz/monetary-policy/operations/fiscal-agent/"><span>Fiskal agent
                                operatsiyalari</span></a>
                          </li>
                          <li>
                            <a href="/uz/monetary-policy/operations/advertisement/"><span>Operatsiyalar o‘tkazilishi
                                bo‘yicha
                                e’lonlar</span></a>
                          </li>
                        </ul>
                      </li>
                      <li>
                        <a href="/uz/monetary-policy/local-currency-yield-curve/"><span>Daromadlilik egri
                            chizig’i</span></a>
                      </li>
                      <li>
                        <a href="/uz/monetary-policy/standards-required-reserves/" class="drop_nav"><span>Majburiy
                            zaxiralar</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                              <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                            </svg></i></a>
                        <ul class="navigation__third">
                          <li>
                            <a href="/uz/monetary-policy/standards-required-reserves/schedule/"><span>Majburiy
                                rezervlarni saqlash va hisob-kitob
                                davri taqvimi</span></a>
                          </li>
                        </ul>
                      </li>
                      <li>
                        <a href="/uz/monetary-policy/inflationary-expectations/" class="drop_nav"><span>Aholi va
                            korxonalarning inflyatsion
                            kutilmalari</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                              <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                            </svg></i></a>
                        <ul class="navigation__third">
                          <li>
                            <a href="/uz/monetary-policy/inflationary-expectations/survey-results/"><span>Inflyatsion
                                kutilmalar va sezilgan
                                inflyatsiya bo‘yicha so‘rov natijalari</span></a>
                          </li>
                        </ul>
                      </li>
                      <li>
                        <a href="/uz/monetary-policy/annual-inflation/" class="drop_nav"><span>Inflyatsiya
                            dinamikasi</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                              <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                            </svg></i></a>
                        <ul class="navigation__third">
                          <li>
                            <a href="/uz/monetary-policy/annual-inflation/components/"><span>Inflyatsiya
                                komponentlari</span></a>
                          </li>
                          <li>
                            <a href="/uz/monetary-policy/annual-inflation/types/"><span>Oziq-ovqat, nooziq-ovqat va
                                xizmatlar
                                inflyatsiyasi</span></a>
                          </li>
                          <li>
                            <a href="/uz/monetary-policy/annual-inflation/indicators/"><span>Yillik, yil boshidan va
                                oylik
                                inflyatsiya</span></a>
                          </li>
                        </ul>
                      </li>
                      <li>
                        <a href="/uz/monetary-policy/inflation-calculator/"><span>Inflyatsiya kalkulyatori</span></a>
                      </li>
                      <li>
                        <a href="/uz/monetary-policy/market/"><span>Ichki valyuta bozorida etika kodeksi</span></a>
                      </li>
                    </ul>
                  </li>
                  <li>
                    <a href="/uz/financial-stability/" class="drop_nav"><span>Moliyaviy bаrqаrоrlik</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                          <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                        </svg></i></a><a href="/uz/financial-stability/" class="navigation__primary_title nav_desktop"><span>Moliyaviy bаrqаrоrlik</span></a>
                    <ul class="navigation__second">
                      <li>
                        <a href="/uz/financial-stability/about/"><span>Moliyaviy barqarorlik haqida</span></a>
                      </li>
                      <li>
                        <a href="/uz/financial-stability/report/"><span>Moliyaviy bаrqаrоrlik sharhi</span></a>
                      </li>
                      <li>
                        <a href="/uz/financial-stability/macroprudential-policy-strategy/"><span>Makroprudensial siyosat
                            asoslari</span></a>
                      </li>
                      <li>
                        <a href="/uz/financial-stability/macroprudential-policy-tools/" class="drop_nav"><span>Makroprudensial siyosat instrumentlari</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                              <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                            </svg></i></a>
                        <ul class="navigation__third">
                          <li>
                            <a href="/uz/financial-stability/macroprudential-policy-tools/capital-conservation-buffer/"><span>Kapital
                                konservatsiya buferi</span></a>
                          </li>
                          <li>
                            <a href="/uz/financial-stability/macroprudential-policy-tools/countercyclical-capital-buffer/"><span>Kontrsiklik
                                kapital bufer</span></a>
                          </li>
                          <li>
                            <a href="/uz/financial-stability/macroprudential-policy-tools/buffer-for-systemically-important-banks/"><span>Tizimli
                                ahamiyatga molik banklar uchun
                                kapital bufer</span></a>
                          </li>
                        </ul>
                      </li>
                      <li>
                        <a href="/uz/financial-stability/research-analysis/"><span>Tadqiqot va tahlillar</span></a>
                      </li>
                      <li>
                        <a href="/uz/financial-stability/banks-list/" class="drop_nav"><span>Tizimli ahamiyatga molik
                            banklar</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                              <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                            </svg></i></a>
                        <ul class="navigation__third">
                          <li>
                            <a href="/uz/financial-stability/banks-list/procedure/"><span>Tizimli ahamiyatga molik
                                banklarni aniqlash
                                tartibi</span></a>
                          </li>
                          <li>
                            <a href="/uz/financial-stability/banks-list/list/"><span>Tizimli ahamiyatga molik banklar
                                ro‘yxati</span></a>
                          </li>
                        </ul>
                      </li>
                      <li>
                        <a href="/uz/financial-stability/press-releases/"><span>Press-relizlar</span></a>
                      </li>
                    </ul>
                  </li>
                </ul>
                <ul class="navigation__primary">
                  <li>
                    <a href="/uz/research/" class="drop_nav"><span>Tadqiqotlar</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                          <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                        </svg></i></a><a href="/uz/research/" class="navigation__primary_title nav_desktop"><span>Tadqiqotlar</span></a>
                    <ul class="navigation__second">
                      <li>
                        <a href="/uz/research/council/"><span>Tadqiqot kengashi</span></a>
                      </li>
                      <li>
                        <a href="/uz/research/agenda/"><span>Tadqiqot dasturi</span></a>
                      </li>
                      <li>
                        <a href="/uz/research/analytical-notes/"><span>Tahliliy materiallar</span></a>
                      </li>
                      <li>
                        <a href="/uz/research/economic/"><span>Iqtisodiy tadqiqotlar</span></a>
                      </li>
                      <li>
                        <a href="/uz/research/hub/" class="drop_nav"><span>Tadqiqotlar maydoni</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                              <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                            </svg></i></a>
                        <ul class="navigation__third">
                          <li>
                            <a href="/uz/research/hub/news/"><span>CBU Challenge</span></a>
                          </li>
                          <li>
                            <a href="/uz/research/hub/grants/"><span>Markaziy bank grantlari</span></a>
                          </li>
                          <li>
                            <a href="/uz/research/hub/fellowship/"><span>Tadqiqot stipendiyasi</span></a>
                          </li>
                          <li>
                            <a href="/uz/research/hub/joint/"><span>Qo‘shma tadqiqotlar</span></a>
                          </li>
                          <li>
                            <a href="/uz/research/hub/competition/"><span>Markaziy bank tanlovi</span></a>
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <li>
                    <a href="/uz/statistics/" class="drop_nav"><span>Statistika</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                          <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                        </svg></i></a><a href="/uz/statistics/" class="navigation__primary_title nav_desktop"><span>Statistika</span></a>
                    <ul class="navigation__second">
                      <li>
                        <a href="/uz/statistics/dks/"><span>Pul-kredit va moliyaviy statistika</span></a>
                      </li>
                      <li>
                        <a href="/uz/statistics/bankstats/"><span>Bank tizimi faoliyati ko‘rsatkichlari</span></a>
                      </li>
                      <li>
                        <a href="/uz/statistics/credit/"><span>Nobank kredit tashkilotlarining
                            ko‘rsatkichlari</span></a>
                      </li>
                      <li>
                        <a href="/uz/statistics/paysistem/"><span>To‘lov tizimining ko‘rsatkichlari</span></a>
                      </li>
                      <li>
                        <a href="/uz/statistics/intlreserves/"><span>O’zbekiston Respublikasining xalqaro
                            zaxiralari</span></a>
                      </li>
                      <li>
                        <a href="/uz/statistics/bop/"><span>O‘zbekiston Respublikasi to‘lov balansi, xalqaro
                            investitsiyaviy mavqei va tashqi qarzi</span></a>
                      </li>
                      <li>
                        <a href="/uz/statistics/financing/"><span>Tijorat banklari tomonidan investitsion
                            loyihalarni moliyalashtirish</span></a>
                      </li>
                      <li>
                        <a href="/uz/statistics/buleten/"><span>Markaziy bankning statistik byulleteni</span></a>
                      </li>
                      <li>
                        <a href="/uz/statistics/e-gdds/data/"><span>Kengaytirilgan Ma’lumotlarni tarqatishning umumiy
                            tizimi (k-MTUT)</span></a>
                      </li>
                      <li>
                        <a href="/uz/statistics/calendar-statistical-data/"><span>Rasmiy veb-saytda statistik
                            ma'lumotlarni e'lon
                            qilish taqvimi</span></a>
                      </li>
                      <li>
                        <a href="/uz/statistics/calendar/"><span>k-MTUT doirasida ma’lumotlarni e’lon qilish
                            taqvimi</span></a>
                      </li>
                    </ul>
                  </li>
                  <li>
                    <a href="/uz/egovernment/" class="drop_nav"><span>Elektron hukumat</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                          <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                        </svg></i></a><a href="/uz/egovernment/" class="navigation__primary_title nav_desktop"><span>Elektron hukumat</span></a>
                    <ul class="navigation__second">
                      <li>
                        <a href="/uz/egovernment/role/"><span>Markaziy bankning “Elektron hukumat” tizimida
                            qatnashishda tutgan o‘rni va roli</span></a>
                      </li>
                      <li>
                        <a href="/uz/egovernment/events/"><span>“Elektron hukumat” tizimi tarkibida amalga
                            oshiriladigan chora-tadbirlar</span></a>
                      </li>
                      <li>
                        <a href="/uz/egovernment/bpr/"><span>Davlat xizmatlarini ko‘rsatish tartibini
                            takomillashtirish bo‘yicha sharh</span></a>
                      </li>
                    </ul>
                  </li>
                  <li>
                    <a href="/uz/other-resources/"><span>Boshqa manbalar</span></a>
                  </li>
                  <li>
                    <a href="/uz/government-programs/"><span>Davlat dasturlari</span></a>
                  </li>
                  <li>
                    <a href="/uz/payment-systems/" class="drop_nav"><span>To‘lov tizimlari</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                          <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                        </svg></i></a><a href="/uz/payment-systems/" class="navigation__primary_title nav_desktop"><span>To‘lov tizimlari</span></a>
                    <ul class="navigation__second">
                      <li>
                        <a href="/uz/payment-systems/registers/" class="drop_nav"><span>To‘lov tizimlari operatorlari va
                            to‘lov
                            tashkilotlari reestrlari</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                              <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                            </svg></i></a>
                        <ul class="navigation__third">
                          <li>
                            <a href="/uz/payment-systems/registers/operators-of-payment-systems/"><span>To’lov tizimlari
                                operatorlari </span></a>
                          </li>
                          <li>
                            <a href="/uz/payment-systems/registers/payment-organizations/"><span>To’lov
                                tashkilotlari</span></a>
                          </li>
                        </ul>
                      </li>
                      <li>
                        <a href="/uz/payment-systems/history/"><span>O‘zbekiston Respublikasida to‘lov tizimining
                            rivojlanish bosqichlari</span></a>
                      </li>
                      <li>
                        <a href="/uz/payment-systems/interbank/"><span>Markaziy bankning banklararo to‘lov
                            tizimi</span></a>
                      </li>
                      <li>
                        <a href="/uz/payment-systems/payment-documents/"><span>To‘lov hujjatlari</span></a>
                      </li>
                      <li>
                        <a href="/uz/payment-systems/interbank-calculations/"><span>Bank kartalari asosida banklararo
                            chakana to‘lov
                            tizimlari</span></a>
                      </li>
                      <li>
                        <a href="/uz/payment-systems/remote-banking-services/"><span>Masofadan xizmat ko‘rsatish
                            tizimlari</span></a>
                      </li>
                      <li>
                        <a href="/uz/payment-systems/clearing-operations/"><span>Kliring tizimi</span></a>
                      </li>
                      <li>
                        <a href="/uz/payment-systems/tariffs-for-payment-services/"><span>Toʼlov xizmatlari
                            tariflari</span></a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="navigation__main_two">
                <ul class="navigation__primary">
                  <li>
                    <a href="/uz/documents/" class="drop_nav"><span>Bank qonunchiligi</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                          <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                        </svg></i></a><a href="/uz/documents/" class="navigation__primary_title nav_desktop"><span>Bank
                        qonunchiligi</span></a>
                    <ul class="navigation__second">
                      <li>
                        <a href="/uz/documents/3327/"><span>Qonunlar</span></a>
                      </li>
                      <li>
                        <a href="/uz/documents/3328/"><span>Prezident farmonlari</span></a>
                      </li>
                      <li>
                        <a href="/uz/documents/3329/"><span>Prezident qarorlari</span></a>
                      </li>
                      <li>
                        <a href="/uz/documents/3330/"><span>Vazirlar Mahkamasi qarorlari</span></a>
                      </li>
                      <li>
                        <a href="/uz/documents/3331/"><span>Me’yoriy hujjatlar</span></a>
                      </li>
                      <li>
                        <a href="/uz/documents/3332/"><span>Me’yoriy hujjatlarga sharhlar</span></a>
                      </li>
                      <li>
                        <a href="/uz/documents/3333/"><span>Bank xodimining kasb odob-ahloqi kodeksi</span></a>
                      </li>
                      <li>
                        <a href="/uz/documents/3343/"><span>Tadbirkorlik faoliyatiga aralashmaslik</span></a>
                      </li>
                      <li>
                        <a href="/uz/documents/4658/"><span>Tartibga solish ta’sirini baholash</span></a>
                      </li>
                      <li>
                        <a href="/uz/documents/izmenyonnie-dokumenti/"><span>O‘z kuchini yo‘qotgan normativ
                            hujjatlar</span></a>
                      </li>
                      <li>
                        <a href="/uz/documents/list-projects-normative/"><span>Me’yoriy hujjatlar loyihalarini muhokama
                            etish</span></a>
                      </li>
                    </ul>
                  </li>
                  <li>
                    <a href="/uz/consumer-protection/" class="drop_nav"><span>Bank xizmatlari iste’molchilarining
                        huquqlarini
                        himoya qilish</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                          <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                        </svg></i></a><a href="/uz/consumer-protection/" class="navigation__primary_title nav_desktop"><span>Bank xizmatlari iste’molchilarining
                        huquqlarini
                        himoya qilish</span></a>
                    <ul class="navigation__second">
                      <li>
                        <a href="/uz/consumer-protection/reminder-of-consumer-banking-services/"><span>Bank xizmatlari
                            iste’molchilariga eslatma</span></a>
                      </li>
                    </ul>
                  </li>
                  <li>
                    <a href="/uz/anti-corruption/" class="drop_nav"><span>Korrupsiyaga qarshi kurashish</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                          <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                        </svg></i></a><a href="/uz/anti-corruption/" class="navigation__primary_title nav_desktop"><span>Korrupsiyaga qarshi kurashish</span></a>
                    <ul class="navigation__second">
                      <li>
                        <a href="/uz/anti-corruption/documents/"><span>O‘zbekiston Respublikasi Markaziy bankining
                            Korrupsiyaga qarshi kurashish bo‘yicha ichki
                            me’yoriy hujjatlari</span></a>
                      </li>
                      <li>
                        <a href="/uz/anti-corruption/send/"><span>Markaziy bank xodimlarining korruptsion
                            hatti-harakatlariga oid xabarlarni yuborish</span></a>
                      </li>
                      <li>
                        <a href="/uz/anti-corruption/events/"><span>Tadbirlar</span></a>
                      </li>
                      <li>
                        <a href="/uz/anti-corruption/communication-channels/"><span>Aloqa kanallari</span></a>
                      </li>
                      <li>
                        <a href="/uz/anti-corruption/handouts/"><span>Targ‘ibot materiallari</span></a>
                      </li>
                      <li>
                        <a href="/uz/anti-corruption/articles/"><span>Maqolalar</span></a>
                      </li>
                      <li>
                        <a href="/uz/anti-corruption/presentations/"><span>Taqdimotlar</span></a>
                      </li>
                    </ul>
                  </li>
                  <li>
                    <a href="/uz/map/"><span>Sayt xaritasi</span></a>
                  </li>
                  <li>
                    <a href="/uz/credit-organizations/" class="drop_nav"><span>Kredit tashkilotlari</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                          <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                        </svg></i></a><a href="/uz/credit-organizations/" class="navigation__primary_title nav_desktop"><span>Kredit tashkilotlari</span></a>
                    <ul class="navigation__second">
                      <li>
                        <a href="/uz/credit-organizations/banks/" class="drop_nav"><span>Tijorat banklari</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                              <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                            </svg></i></a>
                        <ul class="navigation__third">
                          <li>
                            <a href="/uz/credit-organizations/banks/head-offices/"><span>Tijorat banklarining bosh
                                ofislari</span></a>
                          </li>
                          <li>
                            <a href="/uz/credit-organizations/banks/branches/"><span>Tijorat banklarining
                                filiallari</span></a>
                          </li>
                          <li>
                            <a href="/uz/credit-organizations/banks/atm/"><span>Bankomatlar</span></a>
                          </li>
                          <li>
                            <a href="/uz/credit-organizations/banks/exchange-offices/"><span>Ayirboshlash
                                shoxobchalari</span></a>
                          </li>
                          <li>
                            <a href="/uz/credit-organizations/banks/rating-scores/"><span>Reyting baholari</span></a>
                          </li>
                        </ul>
                      </li>
                      <li>
                        <a href="/uz/credit-organizations/microcredit/"><span>Mikromoliya tashkilotlari</span></a>
                      </li>
                      <li>
                        <a href="/uz/credit-organizations/pawn-shops/"><span>Lombardlar</span></a>
                      </li>
                      <li>
                        <a href="/uz/credit-organizations/offices-foreign-banks/"><span>Chet el banklari
                            vakolatxonalari</span></a>
                      </li>
                      <li>
                        <a href="/uz/credit-organizations/licensing/"><span>Litsenziyalash tartibi</span></a>
                      </li>
                      <li>
                        <a href="/uz/credit-organizations/auditors/"><span>Auditorlik tekshiruvini o'tkazish malaka
                            sertifikatiga ega auditorlar ro'yxati</span></a>
                      </li>
                    </ul>
                  </li>
                  <li>
                    <a href="/uz/cert/" class="drop_nav"><span>CERT-CBU kiberxavfsizlik markazi</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                          <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                        </svg></i></a><a href="/uz/cert/" class="navigation__primary_title nav_desktop"><span>CERT-CBU
                        kiberxavfsizlik markazi</span></a>
                    <ul class="navigation__second">
                      <li>
                        <a href="/uz/cert/about/"><span>Markaziy bank “CERT-CBU” kiberxavfsizlik markazi
                            haqida</span></a>
                      </li>
                    </ul>
                  </li>
                </ul>
                <ul class="navigation__primary">
                  <li>
                    <a href="/uz/combating-money-laundering/" class="drop_nav"><span>Jinoiy faoliyatdan olingan
                        daromadlarni
                        legallashtirishga, terrorizmni moliyalashtirishga va
                        ommaviy qirgʻin qurolini tarqatishni
                        moliyalashtirishga qarshi kurashish</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                          <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                        </svg></i></a><a href="/uz/combating-money-laundering/" class="navigation__primary_title nav_desktop"><span>Jinoiy faoliyatdan olingan daromadlarni
                        legallashtirishga, terrorizmni moliyalashtirishga va
                        ommaviy qirgʻin qurolini tarqatishni
                        moliyalashtirishga qarshi kurashish</span></a>
                    <ul class="navigation__second">
                      <li>
                        <a href="/uz/combating-money-laundering/news/"><span>Oxirgi yangiliklar va xabarlar</span></a>
                      </li>
                      <li>
                        <a href="/uz/combating-money-laundering/aml-cft/" class="drop_nav"><span>JFODL/TMQK nazorati
                            yoki MBning JFODL/TMQK
                            nazorati sohasidagi vazifalari va
                            funksiyalari</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                              <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                            </svg></i></a>
                        <ul class="navigation__third">
                          <li>
                            <a href="/uz/combating-money-laundering/aml-cft/about/"><span>Jinoiy faoliyatdan olingan
                                daromadlarni
                                legallashtirishga, terrorizmni
                                moliyalashtirishga va ommaviy qirgʻin qurolini
                                tarqatishni moliyalashtirishga qarshi
                                kurashish sohasi haqida</span></a>
                          </li>
                          <li>
                            <a href="/uz/combating-money-laundering/aml-cft/international-standards/"><span>Xalqaro
                                standartlar va FATFning roli</span></a>
                          </li>
                          <li>
                            <a href="/uz/combating-money-laundering/aml-cft/united-nations/"><span>BMTning roli va
                                Xavfsizlik Kengashi
                                rezolyutsiyalari</span></a>
                          </li>
                          <li>
                            <a href="/uz/combating-money-laundering/aml-cft/national-system/"><span>Oʻzbekiston
                                Respublikasidagi milliy
                                JFODL/TM/OQQTMQK tizimi</span></a>
                          </li>
                          <li>
                            <a href="/uz/combating-money-laundering/aml-cft/eag/"><span>EAG va O‘zbekistonning o‘zaro
                                baholashi</span></a>
                          </li>
                        </ul>
                      </li>
                      <li>
                        <a href="/uz/combating-money-laundering/resources/"><span>Qo‘llanma va resurslar</span></a>
                      </li>
                      <li>
                        <a href="/uz/combating-money-laundering/legislation/"><span>Qonunchilik</span></a>
                      </li>
                      <li>
                        <a href="/uz/combating-money-laundering/glossary/"><span>Izohli lug'at</span></a>
                      </li>
                    </ul>
                  </li>
                  <li>
                    <a href="/uz/banknotes-coins/" class="drop_nav"><span>Banknotalar, Tangalar va Oltin
                        quymalar</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                          <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                        </svg></i></a><a href="/uz/banknotes-coins/" class="navigation__primary_title nav_desktop"><span>Banknotalar, Tangalar va Oltin
                        quymalar</span></a>
                    <ul class="navigation__second">
                      <li>
                        <a href="/uz/banknotes-coins/banknotes/"><span>Banknotlar</span></a>
                      </li>
                      <li>
                        <a href="/uz/banknotes-coins/coins/"><span>Tangalar</span></a>
                      </li>
                      <li>
                        <a href="/uz/banknotes-coins/commemorative-coins/" class="drop_nav"><span>Esdalik
                            tangalari</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                              <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                            </svg></i></a>
                        <ul class="navigation__third">
                          <li>
                            <a href="/uz/banknotes-coins/commemorative-coins/information/"><span>Markaziy bank esdalik
                                tangalari to'g'risida
                                ma'lumot</span></a>
                          </li>
                          <li>
                            <a href="/uz/banknotes-coins/commemorative-coins/catalog/"><span>Sotuvga chiqarilayotgan
                                esdalik
                                tangalari</span></a>
                          </li>
                          <li>
                            <a href="/uz/banknotes-coins/commemorative-coins/price/"><span>Esdalik tangalarining sotuv
                                narxlari</span></a>
                          </li>
                          <li>
                            <a href="/uz/banknotes-coins/commemorative-coins/points-sale/"><span>Esdalik tangalarining
                                sotish va qayta xarid
                                qilish shoxobchalari</span></a>
                          </li>
                          <li>
                            <a href="/uz/banknotes-coins/commemorative-coins/balance/"><span>Esdalik tangalarining
                                qoldig‘i bo‘yicha
                                ma’lumot</span></a>
                          </li>
                          <li>
                            <a href="/uz/banknotes-coins/commemorative-coins/storage/"><span>Esdalik tangalarini saqlash
                                bo‘yicha
                                tavsiyalar</span></a>
                          </li>
                        </ul>
                      </li>
                      <li>
                        <a href="/uz/banknotes-coins/gold-bars/" class="drop_nav"><span>Oltin quymalar</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                              <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                            </svg></i></a>
                        <ul class="navigation__third">
                          <li>
                            <a href="/uz/banknotes-coins/gold-bars/info/"><span>Oʻlchovli oltin quymalar toʻgʻrisidagi
                                maʼlumot</span></a>
                          </li>
                          <li>
                            <a href="/uz/banknotes-coins/gold-bars/list/"><span>Oʻlchovli oltin quymalar va ularning
                                maxsus
                                himoya qadoqlari namunalari</span></a>
                          </li>
                          <li>
                            <a href="/uz/banknotes-coins/gold-bars/prices/"><span>O‘lchovli oltin quymalarni sotish va
                                qaytarib
                                sotib olish narxlari</span></a>
                          </li>
                          <li>
                            <a href="/uz/banknotes-coins/gold-bars/sale-and-buy-back-offices/"><span>Oʻlchovli oltin
                                quymalarning sotish va
                                qaytarib sotib olish shoxobchalari</span></a>
                          </li>
                          <li>
                            <a href="/uz/banknotes-coins/gold-bars/balance/"><span>O'lchovli oltin quymalar qoldig'i
                                bo'yicha
                                ma'lumot</span></a>
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <li>
                    <a href="/uz/publications/" class="drop_nav"><span>Nashrlar</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                          <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                        </svg></i></a><a href="/uz/publications/" class="navigation__primary_title nav_desktop"><span>Nashrlar</span></a>
                    <ul class="navigation__second">
                      <li>
                        <a href="/uz/publications/annual-report/"><span>Markaziy bankning yillik hisoboti</span></a>
                      </li>
                      <li>
                        <a href="/uz/statistics/buleten/"><span>Markaziy bankning statistik byulleteni</span></a>
                      </li>
                      <li>
                        <a href="/uz/publications/survey-results/"><span>Iqtisodiyotning real sektoridagi holat va
                            kutilmalarni o‘rganish natijalari</span></a>
                      </li>
                      <li>
                        <a href="/uz/publications/balance-of-payments/"><span>O‘zbekiston Respublikasi to‘lov balansi,
                            xalqaro
                            investitsiyaviy mavqei va tashqi qarzi</span></a>
                      </li>
                    </ul>
                  </li>
                  <li>
                    <a href="/uz/arkhiv-kursov-valyut/" class="drop_nav"><span>Valyutalar kurslari arxivi</span><i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                          <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                        </svg></i></a><a href="/uz/arkhiv-kursov-valyut/" class="navigation__primary_title nav_desktop"><span>Valyutalar kurslari arxivi</span></a>
                    <ul class="navigation__second">
                      <li>
                        <a href="/uz/arkhiv-kursov-valyut/index.php"><span>Valyutalar kurslari arxivi</span></a>
                      </li>
                      <li>
                        <a href="/uz/arkhiv-kursov-valyut/dinamika-kursov-valyut/"><span>Valyutalar kurslari
                            dinamikasi</span></a>
                      </li>
                      <li>
                        <a href="/uz/arkhiv-kursov-valyut/informer-kursa-valyut/"><span>Valyutalar kurslari
                            informeri</span></a>
                      </li>
                      <li>
                        <a href="/uz/arkhiv-kursov-valyut/reference/"><span>Valyutalar kurslari haqida
                            ma’lumotnoma</span></a>
                      </li>
                      <li>
                        <a href="/uz/arkhiv-kursov-valyut/veb-masteram/"><span>Dasturchilarga</span></a>
                      </li>
                      <li>
                        <a href="https://cbu.uz/uz/arkhiv-kursov-valyut/xml/" target="_blank"><span>XML formatida</span></a>
                      </li>
                      <li>
                        <a href="https://cbu.uz/uz/services/open_data/rates/csv/" target="_blank"><span>CSV formatida</span></a>
                      </li>
                      <li>
                        <a href="https://cbu.uz/uz/arkhiv-kursov-valyut/json/" target="_blank"><span>JSON formatida</span></a>
                      </li>
                    </ul>
                  </li>
                  <li>
                    <a href="/uz/search/"><span>Izlash</span></a>
                  </li>
                  <li>
                    <a href="/uz/search/advanced.php"><span>Kengaytirilgan qidiruv</span></a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="navigation__bottom">
              <a class="navigation__bottom_item" href="/uz/contacts/">
                <i>
                  <svg class="ico_svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__map_pin" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                  </svg>
                </i>
                <span>Biz bilan bog‘lanish</span>
              </a>
              <a class="navigation__bottom_item" href="/uz/services/online-reception/">
                <i>
                  <svg class="ico_svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__briefcase" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                  </svg>
                </i>
                <span>Virtual qabulxona</span>
              </a>
            </div>
          </div>
        </div><div id="mCSB_1_scrollbar_vertical" class="mCSB_scrollTools mCSB_1_scrollbar mCS-dark mCSB_scrollTools_vertical" style="display: block;"><div class="mCSB_draggerContainer"><div id="mCSB_1_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; display: block; height: 388px; max-height: 826.075px; top: 0px;"><div class="mCSB_dragger_bar" style="line-height: 30px;"></div></div><div class="mCSB_draggerRail"></div></div></div></div></div>
      </div>
    </div>
    <!-- .page__top -->

    <section class="main">
      <div class="container">
        <div class="main__row">
          <div class="main__content js-content-block">
            <div class="main__top">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item" itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb">
                    <a itemprop="url" href="#" title="Bosh sahifa"><span itemprop="title">Bosh sahifa</span></a>
                  </li>
                  <li class="breadcrumb-item" itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb">
                    <a itemprop="url" href="#" title="Bank haqida"><span itemprop="title">Bank
                        haqida</span></a>
                  </li>
                  <li class="breadcrumb-item active" itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb" aria-current="page">
                    <span itemprop="title" title="Xalqaro hamkorlik">Xalqaro hamkorlik</span>
                  </li>
                </ol>
              </nav>
              <div class="main_views hide-xs-only">
                <i><svg class="ico_svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__eye" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                  </svg></i><span id="pc-ppc" class="js-ppcs"><!--'start_frame_cache_pc-ppc'-->11
                  738<!--'end_frame_cache_pc-ppc'--></span>
              </div>
              <a href="#" class="main_rss hide-xs-only" style="display: none">
                <i><svg class="ico_svg" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg">
                    <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__rss" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                  </svg></i>
                <span>RSS bo‘yicha obuna bo‘lmoq</span>
              </a>
            </div>
            <h1 class="heading_border">O‘zbekiston Respublikasi rezidentlarining xorijiy kompaniyalar va onlayn
              kazinolardan olingan daromadlarini soliqqa tortish tartibi
            </h1>
            <div class="lastmodify-page text-right">
              <span class="item-title"><b>Yangilangan sana:</b>&nbsp;</span><span class="item-date" id="pc-pdus"><!--'start_frame_cache_pc-pdus'-->17 Iyul 2019,
                15:05<!--'end_frame_cache_pc-pdus'--></span>
            </div>

            <div class="_news-detail-new ">



              


              <div class="main_text" itemprop="articleBody">
                <p>
                  O‘zbekiston Respublikasi Markaziy banki jismoniy shaxslar tomonidan xorijiy kompaniyalardan, shu jumladan litsenziyalangan onlayn kazinolarda yutuq ko‘rinishida olingan daromadlarni soliqqa tortish tartibini tushuntiradi.
                </p>
                <p>
                  O‘zbekiston Respublikasi Soliq kodeksining 369–371-moddalariga muvofiq, agar jismoniy shaxs O‘zbekiston Respublikasi rezidenti bo‘lsa, u tomonidan xorijiy manbalardan olingan har qanday daromad O‘zbekiston Respublikasi hududida soliqqa tortiladi. Ushbu qoida daromadni olish shakli, valyutasi va mablag‘larni o‘tkazish usulidan qat’i nazar qo‘llaniladi.

                </p>
                <p>
                  Bunday daromadlarga xorijiy onlayn platformalar va litsenziyalangan kazinolardan olingan yutuqlar, to‘lovlar hamda boshqa pul tushumlari kiradi.

                </p>
                <p>
                  O‘zbekiston Respublikasi Markaziy bankining 3300-sonli Nizomi talablariga muvofiq, litsenziyalangan kazinolardan pul mablag‘larini chiqarishda belgilangan soliqqa tortish tartibi qo‘llaniladi. Soliq miqdori chiqarilayotgan summa&shy;ning 10 foizini tashkil etadi.

                </p>
                <p>
                  Shu bilan birga, mazkur soliq foydalanuvchining o‘yin balansidan avtomatik tarzda ushlab qolinmasligini inobatga olish muhim. Uni to‘lash majburiyati bevosita daromad oluvchining o‘z zimmasiga yuklatiladi. Bu shuni anglatadiki, pul mablag‘larini amalda chiqarishdan oldin jismoniy shaxs soliqni belgilangan tartibda mustaqil ravishda to‘lashi lozim.

                </p>

                <p>
                  Alohida ta’kidlash joizki, ushbu soliq qaytariladigan hisoblanadi. Soliq davri yakunlariga ko‘ra, jismoniy shaxsda soliq qonunchiligiga muvofiq to‘langan soliqni qaytarib olish huquqi yuzaga kelishi mumkin. Bunday hollarda soliqni qaytarish O‘zbekiston Respublikasi soliq organlari orqali belgilangan tartibda amalga oshiriladi.

                </p>


                <p>
                  Soliq qonunchiligi talablariga rioya etilmasligi O‘zbekiston Respublikasi qonunchiligida nazarda tutilgan javobgarlik choralariga, jumladan jarimalar va boshqa ta’sir choralariga olib kelishi mumkin.

                </p>

                <p>
                  O‘zbekiston Respublikasi Markaziy banki jismoniy shaxslarga xorijiy manbalardan olinayotgan daromadlarga mas’uliyat bilan yondashishni, ularni o‘z vaqtida deklaratsiya qilishni va soliq to‘lovlari bo‘yicha majburiyatlarni bajarishni tavsiya etadi. Ushbu talablarga rioya etish moliyaviy operatsiyalarning shaffofligini oshirishga hamda mamlakat moliya tizimining barqarorligiga xizmat qiladi.

                </p>
              </div>




              <div class="clearfix"></div>





              <div class="item-photos no-print">

              </div><!-- .item-photos -->


              <div class="main_bottom mb_40 no-print">
                
                <div class="main_views hide-lg hide-xly">
                  <i>
                    <svg class="ico_svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__eye" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                    </svg>
                  </i>
                  <span>11 738</span>
                </div>
              </div>

           



              <div class="item-see-also">

                

              </div>

            </div>
          </div>
          <!-- .main__content -->

          <div class="main__sidebar">
            
          </div>
          <!-- .main__sidebar -->
        </div>
        <!-- .main__row -->
      </div>
      <!-- .container -->
    </section>
    <!-- .main -->

    <section class="rate">
      <div class="container">
        <div class="rate__row">
          <div class="rate__line">
            <div class="rate__item">
              <div class="rate__item_flag">
                <svg class="ico_svg" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                  <use xlink:href="/bitrix/templates/main/img/symbol_defs.svg#icon-currency-USD" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                </svg>
              </div>
              <div class="rate__item_content">
                <div class="rate__item_value">
                  <strong>USD</strong> = 12128.02
                </div>
                <div class="rate__item_shift color_green">+29.9</div>
              </div>
              <div class="rate__item_chart">
                <img src="/bitrix/templates/main/img/svg/icon__chart_up.svg" class="img_fluid" alt="">
              </div>
            </div>
            <div class="rate__item">
              <div class="rate__item_flag">
                <svg class="ico_svg" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                  <use xlink:href="/bitrix/templates/main/img/symbol_defs.svg#icon-currency-EUR" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                </svg>
              </div>
              <div class="rate__item_content">
                <div class="rate__item_value">
                  <strong>EUR</strong> = 14419.00
                </div>
                <div class="rate__item_shift color_green">+65.79</div>
              </div>
              <div class="rate__item_chart">
                <img src="/bitrix/templates/main/img/svg/icon__chart_up.svg" class="img_fluid" alt="">
              </div>
            </div>
            <div class="rate__item">
              <div class="rate__item_flag">
                <svg class="ico_svg" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                  <use xlink:href="/bitrix/templates/main/img/symbol_defs.svg#icon-currency-RUB" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                </svg>
              </div>
              <div class="rate__item_content">
                <div class="rate__item_value">
                  <strong>RUB</strong> = 158.52
                </div>
                <div class="rate__item_shift color_red">-0.12</div>
              </div>
              <div class="rate__item_chart">
                <img src="/bitrix/templates/main/img/svg/icon__chart_down.svg" class="img_fluid" alt="">
              </div>
            </div>
            <div class="rate__item">
              <div class="rate__item_flag">
                <svg class="ico_svg" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                  <use xlink:href="/bitrix/templates/main/img/symbol_defs.svg#icon-currency-GBP" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                </svg>
              </div>
              <div class="rate__item_content">
                <div class="rate__item_value">
                  <strong>GBP</strong> = 16615.39
                </div>
                <div class="rate__item_shift color_green">+74.84</div>
              </div>
              <div class="rate__item_chart">
                <img src="/bitrix/templates/main/img/svg/icon__chart_up.svg" class="img_fluid" alt="">
              </div>
            </div>
            <div class="rate__item">
              <div class="rate__item_flag">
                <svg class="ico_svg" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                  <use xlink:href="/bitrix/templates/main/img/symbol_defs.svg#icon-currency-JPY" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                </svg>
              </div>
              <div class="rate__item_content">
                <div class="rate__item_value">
                  <strong>JPY</strong> = 78.89
                </div>
                <div class="rate__item_shift color_green">+0.16</div>
              </div>
              <div class="rate__item_chart">
                <img src="/bitrix/templates/main/img/svg/icon__chart_up.svg" class="img_fluid" alt="">
              </div>
            </div>
            <div class="rate__item hide-lg-only">
              <div class="rate__item_flag">
                <svg class="ico_svg" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                  <use xlink:href="/bitrix/templates/main/img/symbol_defs.svg#icon-currency-CHF" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                </svg>
              </div>
              <div class="rate__item_content">
                <div class="rate__item_value">
                  <strong>CHF</strong> = 15634.94
                </div>
                <div class="rate__item_shift color_green">+42.57</div>
              </div>
              <div class="rate__item_chart">
                <img src="/bitrix/templates/main/img/svg/icon__chart_up.svg" class="img_fluid" alt="">
              </div>
            </div>
            <div class="rate__item hide-lg-only hide-xl-only">
              <div class="rate__item_flag">
                <svg class="ico_svg" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                  <use xlink:href="/bitrix/templates/main/img/symbol_defs.svg#icon-currency-CNY" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
                </svg>
              </div>
              <div class="rate__item_content">
                <div class="rate__item_value">
                  <strong>CNY</strong> = 1743.73
                </div>
                <div class="rate__item_shift color_green">+4.04</div>
              </div>
              <div class="rate__item_chart">
                <img src="/bitrix/templates/main/img/svg/icon__chart_up.svg" class="img_fluid" alt="">
              </div>
            </div>
          </div>
          <a href="/uz/arkhiv-kursov-valyut/" class="rate__button">
            <span>Barcha valyutalar</span>
            <i><svg class="ico_svg" viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                <use xlink:href="/bitrix/templates/main/img/sprite_icons.svg#icon__chevron_down" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
              </svg></i>
          </a>
        </div>
      </div>
    </section>

   

    <section class="apps">
      <div class="container">
        <div class="apps__row">
          <div class="apps__logo">
            <div class="apps__logo_image">
              <img src="/bitrix/templates/main/img/mini_logo.svg" alt="">
            </div>
            <div class="apps__logo_text">
              <span>Yangi ilova</span>
              <strong>O‘zbekiston Respublikasi Markaziy banki</strong>
            </div>
          </div>
          <div class="apps__text">
            Online доступ к общедоступным информационным ресурсам ЦБ РУз в
            сети Интернет, с возможностью просматривать и получать обновленную
            информацию, в том числе сведения о курсах валют.
          </div>
          <div class="apps__links">
            <a href="https://cbu.uz/uz/services/app/">
              <img src="/upload/iblock/cf5/GooglePlay_uzb.png" class="img_fluid" alt="">
            </a>
            <a href="https://apps.apple.com/us/app/central-bank-of-uzbekistan/id1552860709" target="_blank">
              <img src="/upload/iblock/e4f/AppStore_uzb.png" class="img_fluid" alt="">
              <div class="apps__qr">
                <img src="/upload/iblock/129/appstore_qr_code.gif" class="img_fluid" alt="">
              </div>
            </a>
          </div>
          <div class="apps__image sv-img">
            <img src="/bitrix/templates/main/img/apps__image.png" class="img_fluid" alt="">
          </div>
        </div>
      </div>
    </section>

    <footer class="footer">
      

      <div class="footer__bottom">
        
      </div>
    </footer>
  </div>
  <!-- .page -->

  <span style="" id="sexy_tooltip_title"><span class="the-tooltip top left dark-midnight-blue"><span class="tooltip_inner">Belgilangan matnni tinglash uchun quyidagi tugmani bosing</span></span></span>
  <span style="position: absolute; margin-top: -50000px" id="sexy_tooltip"><span class="the-tooltip bottom left dark-midnight-blue"><span class="tooltip_inner powered_by_3 powered_by">Powered by
        <a href="#" target="_top" class="backlink_a">X</a></span></span></span>

  <div id="sound_container" class="sound_div sound_div_basic size_1 speaker_32" title="">
    <div id="sound_text"></div>
  </div>

  <div id="sound_audio"></div>

  <div class="modal fade" id="myModalSpeech" tabindex="-1" role="dialog" aria-labelledby="myModalSpeechLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalSpeechLabel">
            Matnni audio holatda tinglash
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <p>
            Veb-saytda matnni audio holatda tinglash mumkin.
            <br><br>Matnni tinglash uchun uni sichqoncha bilan ajratib
            oling va paydo bo`lgan belgini bosing.
          </p>
          <h5>Ekran suxandoni</h5>
          <label><input id="speechSwitcher" title="Ekran suxandon funksiyasi yoqildi" name="speechSwitcher" type="checkbox">
            Yoqish / O`chirish</label>
        </div>
      </div>
    </div>
  </div>

  <div id="pc-back-top" style="display: block;">
    <a href="#top"><span class="fa fa-chevron-up"></span></a>
  </div>

  <script>
    var PORTAL_MESS = {};
    PORTAL_MESS["TEST_VERSION_1"] = "Sayt test rejimida ishlaydi";
    PORTAL_MESS["TEST_VERSION_2"] =
      "#URL_START#Aloqa formasi#URL_END# orqali yuboriladi sharxlar va takliflar";
    PORTAL_MESS["TEST_VERSION_3"] =
      "Sayt eski versiyasi bu manzilda #SITE# joylashgan";
    PORTAL_MESS["SUM"] = "sum";
    PORTAL_MESS["TIYIN"] = "tiyin";
    PORTAL_MESS["CALC_WAIT"] = "hisoblash... kutish...";
    PORTAL_MESS["OB_TEXT_1"] =
      "Siz, eski brauzerdan foydalanayotganligingizni bilasizmi?";
    PORTAL_MESS["OB_TEXT_2"] =
      "Sizning brauzeringiz juda eski va mazkur saytni noto‘g‘ri aks ettirishi mumkin. Siz o‘zingizga istalgan zamonaviyroq brauzerni o‘rnatishingiz mumkin";
    PORTAL_MESS["OB_TEXT_3"] =
      "Oddiygina, o‘zingiz yoqtirgan brauzer tugmachasini bosing va uni ko‘chirib olish sahifasiga o‘tasiz";
    PORTAL_MESS["OB_TEXT_4"] =
      "Ushbu oynani yopish orqali Siz brauzeringiz eskiligiga rozilik bildirasiz va zamonaviyroq brauzerni ko‘chirib olish istagingizni tasdiqlaysiz";
    PORTAL_MESS["OB_TEXT_5"] = "Ushbu oyna yopilsin";
    PORTAL_MESS["SHOW_ON_MAP"] = "Xaritada ko‘rsatish";
    PORTAL_MESS["STAT_COMPLETE"] = "Yakunlanganlar";
    PORTAL_MESS["STAT_RECEIVED"] = "Kelib tushganlar";
    PORTAL_MESS["USD"] = "USD";
    PORTAL_MESS["USDEUR"] = "USD";
    PORTAL_MESS["EUR"] = "EURO";
    PORTAL_MESS["UZS"] = "so‘m";
  </script>
  <script>
    function ip_alert(text) { }
  </script>
  <script>
    if (!window.BX) window.BX = {};
    if (!window.BX.message)
      window.BX.message = function (mess) {
        if (typeof mess === "object") {
          for (let i in mess) {
            BX.message[i] = mess[i];
          }
          return true;
        }
      };
  </script>
  <script>
    (window.BX || top.BX).message({
      pull_server_enabled: "N",
      pull_config_timestamp: 0,
      shared_worker_allowed: "Y",
      pull_guest_mode: "N",
      pull_guest_user_id: 0,
      pull_worker_mtime: 1746191694,
    });
    (window.BX || top.BX).message({
      PULL_OLD_REVISION:
        "Для продолжения корректной работы с сайтом необходимо перезагрузить страницу.",
    });
  </script>
  <script>
    (window.BX || top.BX).message({
      JS_CORE_LOADING: "Загрузка...",
      JS_CORE_NO_DATA: "- Ma’lumot yo’q -",
      JS_CORE_WINDOW_CLOSE: "Yopish",
      JS_CORE_WINDOW_EXPAND: "Развернуть",
      JS_CORE_WINDOW_NARROW: "Свернуть в окно",
      JS_CORE_WINDOW_SAVE: "Сохранить",
      JS_CORE_WINDOW_CANCEL: "Bekor qilish",
      JS_CORE_WINDOW_CONTINUE: "Продолжить",
      JS_CORE_H: "ч",
      JS_CORE_M: "м",
      JS_CORE_S: "с",
      JSADM_AI_HIDE_EXTRA: "Скрыть лишние",
      JSADM_AI_ALL_NOTIF: "Показать все",
      JSADM_AUTH_REQ: "Требуется авторизация!",
      JS_CORE_WINDOW_AUTH: "Kirish",
      JS_CORE_IMAGE_FULL: "Полный размер",
    });
  </script>
  <script src="/bitrix/js/main/core/core.min.js?1769515992242882"></script>
  <script>
    BX.Runtime.registerExtension({
      name: "main.core",
      namespace: "BX",
      loaded: true,
    });
  </script>
  <script>
    BX.setJSList([
      "\/bitrix\/js\/main\/core\/core_ajax.js",
      "\/bitrix\/js\/main\/core\/core_promise.js",
      "\/bitrix\/js\/main\/polyfill\/promise\/js\/promise.js",
      "\/bitrix\/js\/main\/loadext\/loadext.js",
      "\/bitrix\/js\/main\/loadext\/extension.js",
      "\/bitrix\/js\/main\/polyfill\/promise\/js\/promise.js",
      "\/bitrix\/js\/main\/polyfill\/find\/js\/find.js",
      "\/bitrix\/js\/main\/polyfill\/includes\/js\/includes.js",
      "\/bitrix\/js\/main\/polyfill\/matches\/js\/matches.js",
      "\/bitrix\/js\/ui\/polyfill\/closest\/js\/closest.js",
      "\/bitrix\/js\/main\/polyfill\/fill\/main.polyfill.fill.js",
      "\/bitrix\/js\/main\/polyfill\/find\/js\/find.js",
      "\/bitrix\/js\/main\/polyfill\/matches\/js\/matches.js",
      "\/bitrix\/js\/main\/polyfill\/core\/dist\/polyfill.bundle.js",
      "\/bitrix\/js\/main\/core\/core.js",
      "\/bitrix\/js\/main\/polyfill\/intersectionobserver\/js\/intersectionobserver.js",
      "\/bitrix\/js\/main\/lazyload\/dist\/lazyload.bundle.js",
      "\/bitrix\/js\/main\/polyfill\/core\/dist\/polyfill.bundle.js",
      "\/bitrix\/js\/main\/parambag\/dist\/parambag.bundle.js",
    ]);
  </script>
  <script>
    BX.Runtime.registerExtension({
      name: "ui.design-tokens",
      namespace: "window",
      loaded: true,
    });
  </script>
  <script>
    BX.Runtime.registerExtension({
      name: "ui.fonts.opensans",
      namespace: "window",
      loaded: true,
    });
  </script>
  <script>
    BX.Runtime.registerExtension({
      name: "main.popup",
      namespace: "BX.Main",
      loaded: true,
    });
  </script>
  <script>
    BX.Runtime.registerExtension({
      name: "popup",
      namespace: "window",
      loaded: true,
    });
  </script>
  <script>
    (window.BX || top.BX).message({
      LANGUAGE_ID: "uz",
      FORMAT_DATE: "DD.MM.YYYY",
      FORMAT_DATETIME: "DD.MM.YYYY HH:MI:SS",
      COOKIE_PREFIX: "BITRIX_SM",
      SERVER_TZ_OFFSET: "18000",
      UTF_MODE: "Y",
      SITE_ID: "s3",
      SITE_DIR: "\/uz\/",
      USER_ID: "",
      SERVER_TIME: 1769593637,
      USER_TZ_OFFSET: 0,
      USER_TZ_AUTO: "Y",
      bitrix_sessid: "039a20311016731c630eb4c96b778a96",
    });
  </script>
  <script src="/bitrix/js/pull/protobuf/protobuf.js?1659956399274055"></script>
  <script src="/bitrix/js/pull/protobuf/model.min.js?165995639914190"></script>
  <script src="/bitrix/js/main/core/core_promise.min.js?17695159922494"></script>
  <script src="/bitrix/js/rest/client/rest.client.min.js?15823123748529"></script>
  <script src="/bitrix/js/pull/client/pull.client.min.js?174619169849849"></script>
  <script src="/bitrix/js/main/popup/dist/main.popup.bundle.min.js?176951599267515"></script>
  <script>
    BX.setJSList([
      "\/bitrix\/templates\/main\/js2\/vendor\/jquery.min.js",
      "\/bitrix\/templates\/main\/js\/jquery.reject-1.1.0.min.js",
      "\/bitrix\/templates\/.default\/components\/bitrix\/news.list\/.cb_contacts_top_main\/js\/script.js",
      "\/bitrix\/templates\/.default\/components\/bitrix\/menu\/.top\/js\/jquery.responsive.menu.min.js",
      "\/bitrix\/templates\/.default\/components\/bitrix\/menu\/.top\/js\/script.js",
      "\/bitrix\/templates\/.default\/components\/bitrix\/menu\/.side\/js\/script.js",
      "\/bitrix\/templates\/main\/js\/jquery.forcenumericonly-0.0.1.min.js",
      "\/bitrix\/templates\/main\/js\/jquery.maskMoney.min.js",
      "\/bitrix\/templates\/.default\/components\/bitrix\/news.list\/.cb_inner_rates\/js\/script.js",
      "\/bitrix\/templates\/.default\/components\/bitrix\/news.list\/.cb_contacts_bottom\/js\/script.js",
      "\/bitrix\/templates\/main\/js\/jQueryRotate-2.1.min.js",
      "\/bitrix\/templates\/main\/js\/jquery.easing-1.3.min.js",
      "\/bitrix\/templates\/main\/js\/mediaelement-and-player-2.16.4.min.js",
      "\/bitrix\/templates\/main\/js\/gspeech-1.0.3.min.js",
      "\/bitrix\/templates\/main\/js\/narrator\/jquery-ui.min.js",
      "\/bitrix\/templates\/main\/js\/narrator\/default.min.js",
      "\/bitrix\/templates\/main\/js\/narrator\/specialView.min.js",
      "\/bitrix\/templates\/main\/js\/narrator\/mousetrap.min.js",
      "\/bitrix\/components\/pixelcraft\/cb.backtotop\/templates\/.default\/js\/script.js",
      "\/bitrix\/templates\/main\/js2\/vendor\/popper.min.js",
      "\/bitrix\/templates\/main\/js2\/vendor\/jquery.cookie.js",
      "\/bitrix\/templates\/main\/js2\/vendor\/bootstrap-4.3.1-dist\/js\/bootstrap.min.js",
      "\/bitrix\/templates\/main\/js2\/vendor\/jquery.fancybox\/jquery.fancybox.min.js",
      "\/bitrix\/templates\/main\/js2\/vendor\/jquery.selectric\/jquery.selectric.js",
      "\/bitrix\/templates\/main\/js2\/vendor\/jquery.mCustomScrollbar\/jquery.mCustomScrollbar.concat.min.js",
      "\/bitrix\/templates\/main\/js2\/vendor\/svg4everybody.legacy.min.js",
      "\/bitrix\/templates\/main\/js2\/vendor\/swiper\/js\/swiper.min.js",
      "\/bitrix\/templates\/main\/js2\/vendor\/aos\/aos.js",
      "\/bitrix\/templates\/main\/js2\/vendor\/gijgo\/js\/gijgo.min.js",
      "\/bitrix\/templates\/main\/js2\/vendor\/spectrum\/spectrum.js",
      "\/bitrix\/templates\/main\/js2\/vendor\/owlcarousel\/owl.carousel.min.js",
      "\/bitrix\/templates\/main\/js2\/vendor\/gijgo\/js\/messages\/messages.ru-ru.min.js",
      "\/bitrix\/templates\/main\/js2\/vendor\/tilt.jquery.min.js",
      "\/bitrix\/templates\/main\/js2\/vendor\/lazyload.js",
      "\/bitrix\/templates\/main\/js2\/vendor\/moment.min.js",
      "\/bitrix\/templates\/main\/js2\/vendor\/moment\/locales.min.js",
      "\/bitrix\/templates\/main\/js2\/vendor\/masonry.pkgd.min.js",
      "\/bitrix\/templates\/main\/js2\/vendor\/chart.js\/Chart.min.js",
      "\/bitrix\/templates\/main\/js2\/vendor\/special_version\/js\/special.min.js",
      "\/bitrix\/templates\/main\/js2\/vendor\/mixitup.min.js",
      "\/bitrix\/templates\/main\/js2\/vendor\/daterangepicker\/daterangepicker.min.js",
      "\/bitrix\/templates\/main\/js2\/vendor\/datetimepicker\/jquery.datetimepicker.full.min.js",
      "\/bitrix\/templates\/main\/js2\/main.js",
      "\/bitrix\/templates\/main\/js\/affix.js",
      "\/bitrix\/templates\/main\/js\/jquery.form-3.0.3.min.js",
      "\/bitrix\/templates\/main\/js\/common.js",
      "\/bitrix\/templates\/main\/js\/common-inner.js",
      "\/bitrix\/templates\/main\/js\/common-prev.js",
    ]);
  </script>
  <script>
    BX.setCSSList([
      "\/bitrix\/components\/bitrix\/system.show_message\/templates\/.default\/style.css",
      "\/bitrix\/templates\/main\/css\/font-awesome.min.css",
      "\/bitrix\/templates\/main\/images\/sprites\/icons.min.css",
      "\/bitrix\/templates\/.default\/components\/bitrix\/menu\/.top\/style.css",
      "\/bitrix\/components\/pixelcraft\/lastmodify.page\/templates\/.default\/style.css",
      "\/bitrix\/templates\/.default\/components\/bitrix\/news.list\/offers4x\/style.css",
      "\/bitrix\/templates\/main\/styles.css",
      "\/bitrix\/templates\/main\/template_styles.css",
      "\/bitrix\/components\/pixelcraft\/document\/templates\/.default\/style.css",
      "\/bitrix\/templates\/main\/css2\/bootstrap.css",
      "\/bitrix\/templates\/main\/js2\/vendor\/gijgo\/css\/gijgo.min.css",
      "\/bitrix\/templates\/main\/js2\/vendor\/aos\/aos.css",
      "\/bitrix\/templates\/main\/js2\/vendor\/chart.js\/Chart.min.css",
      "\/bitrix\/templates\/main\/js2\/vendor\/spectrum\/spectrum.css",
      "\/bitrix\/templates\/main\/js2\/vendor\/owlcarousel\/assets\/owl.carousel.min.css",
      "\/bitrix\/templates\/main\/js2\/vendor\/datetimepicker\/jquery.datetimepicker.min.css",
      "\/bitrix\/templates\/main\/js2\/vendor\/daterangepicker\/daterangepicker.css",
      "\/bitrix\/templates\/main\/js2\/vendor\/owlcarousel\/assets\/owl.theme.default.min.css",
      "\/bitrix\/templates\/main\/css2\/main.css",
      "\/bitrix\/templates\/main\/js2\/vendor\/special_version\/css\/special.min.css",
      "\/bitrix\/templates\/main\/css2\/specialversion.css",
      "\/bitrix\/templates\/main\/css2\/aa_scale.min.css",
      "\/bitrix\/templates\/main\/less\/bootstrap-inner.min.css",
      "\/bitrix\/templates\/main\/css\/_fixedTable.css",
      "\/bitrix\/templates\/main\/css\/gspeech.css",
      "\/bitrix\/templates\/main\/css\/narrator\/main.min.css",
      "\/bitrix\/templates\/main\/css\/narrator\/media.css",
      "\/bitrix\/components\/pixelcraft\/cb.backtotop\/templates\/.default\/css\/style.css",
    ]);
  </script>
  <script type="text/javascript">
    var ALXerrorSendMessages = {
      head: "Matndan topilgan hatolik",
      footer:
        '<b>Muallifga hatolik to’g’risida habar berish kerakmi?</b><br /><span style="font-size: 10px; color: #7d7d7d">(brauzeringiz shu sahifada qoladi)</span>',
      comment: "Muallif uchun mulohaza (zaruriyatda)",
      TitleForm: "Hatolik haqida habar",
      ButtonSend: "Yuborish",
      LongText: "Siz juda katta hajmdagi matnni belgiladingiz.",
      LongText2: "Qaytadan urinib ko’ring.",
      cancel: "Bekor qilish",
      senderror: "Xabar yuborishda xatolik!",
      close: "Yopish",
      text_ok: "Sizning habaringiz yuborildi.",
      text_ok2: "E’tiboringiz uchun rahmat!",
    };
  </script>
  <script type="text/javascript" async="" src="/bitrix/js/altasib.errorsend/error.js"></script>

  <script src="/bitrix/cache/js/s3/main/template_dae820e659d8ecc29f655ea3dbc503c4/template_dae820e659d8ecc29f655ea3dbc503c4_v1.js?17695909631609095"></script>

  <script>
    var PC_ERROR = "Xatolik";
    var PC_AUTH_LOGIN_INCORRECT = "Noto‘g‘ri to‘ldirildi login";
    var PC_AUTH_ENTER_LOGIN = "Login kiriting";
  </script>

  <script>
    var PC_ERROR = "Xatolik";
    var PC_AUTH_LOGIN_INCORRECT = "Noto‘g‘ri to‘ldirildi login";
    var PC_AUTH_ENTER_LOGIN = "Login kiriting";
  </script>

  <script>
    var arCurrencyRates = {
      USD: "12128.02",
      EUR: "14419.00",
      RUB: "158.52",
      GBP: "16615.39",
      JPY: "78.89",
      CHF: "15634.94",
      CNY: "1743.73",
      UZS: 1,
    };
  </script>

  <script>
    $(function () {
      var arDisplayCurrencies = Array(
        "USD",
        "EUR",
        "RUB",
        "GBP",
        "JPY",
        "KZT",
        "UAH"
      );

      jQuery(".exchange_box input[name=date]").datetimepicker({
        //i18n: arLang,
        //i18n: arLangDatetimepicker,
        //lang: 'uz',
        timepicker: false,
        format: "d.m.Y",
        //format: 'd/m/Y',
        inline: false,
        scrollMonth: false,
        scrollInput: false,
        yearStart: "1994",
        yearEnd: "2026",
        maxDate: "0", //today is maximum date calendar
        onSelectDate: function (ct, $input) {
          var date = $input.val();
          $(".exchange_box .sidebar_exchange__item").remove();
          $.ajax({
            type: "POST",
            url: "/common/json/",
            data: "date=" + date,
            beforeSend: function () {
              //$('.table-no-layout').addClass('ajax_prl');
            },
            success: function (tmsg) {
              var iCurrencyIndex = 0;
              $.each(tmsg, function (indexResult, result) {
                if (arDisplayCurrencies.indexOf(result.Ccy) != -1) {
                  var str_icon =
                    result.Diff < 0
                      ? "icon__chart_down"
                      : result.Diff > 0
                        ? "icon__chart_up"
                        : "icon__chart_zero";
                  var str_color =
                    result.Diff < 0
                      ? "color_red"
                      : result.Diff > 0
                        ? "color_green"
                        : "";
                  var str_param = result.Diff == 0 ? "empty" : "";
                  var str_dif =
                    result.Diff > 0 ? "+" + result.Diff : result.Diff;
                  $(".sidebar_exchange__actions").before(
                    '<div class="sidebar_exchange__item">\n' +
                    '    <div class="sidebar_exchange__item_flag">\n' +
                    '        <svg class="ico_svg" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">\n' +
                    '            <use xlink:href="/bitrix/templates/main/img/symbol_defs.svg#icon-currency-' +
                    result.Ccy +
                    '" xmlns:xlink="http://www.w3.org/1999/xlink"></use>\n' +
                    "        </svg>\n" +
                    "    </div>\n" +
                    '    <div class="sidebar_exchange__item_content">\n' +
                    '        <div class="sidebar_exchange__item_value"><strong>' +
                    result.Nominal +
                    " " +
                    result.Ccy +
                    "</strong> = " +
                    result.Rate +
                    "</div>\n" +
                    '        <div class="sidebar_exchange__item_shift ' +
                    str_color +
                    '">' +
                    str_dif +
                    "</div>\n" +
                    "    </div>\n" +
                    '    <div class="sidebar_exchange__item_chart">\n' +
                    '        <img src="/bitrix/templates/main/img/svg/' +
                    str_icon +
                    '.svg" class="img_fluid" alt="">\n' +
                    "    </div>\n" +
                    "</div>"
                  );
                  iCurrencyIndex++;
                }
              });
            },
          });
        },
      });
    });
  </script>

  <script>
    var site_lng = "uz";
    var players = new Array(),
      blink_timer = new Array(),
      rotate_timer = new Array(),
      lang_identifier = "uz",
      selected_txt = "",
      sound_container_clicked = false,
      sound_container_visible = true,
      blinking_enable = true,
      basic_plg_enable = true,
      pro_container_clicked = false,
      streamerphp_folder = "/bitrix/components/pixelcraft/gspeech/",
      translation_tool = "g",
      translation_audio_type = "audio/mpeg",
      speech_text_length = 50,
      blink_start_enable_pro = true,
      createtriggerspeechcount = 0,
      speechtimeoutfinal = 0,
      speechtxt = "",
      userRegistered = "0",
      gspeech_bcp = [
        "rgba(0,0,0,0)",
        "rgba(255,255,255,0)",
        "rgba(255,255,255,0)",
        "rgba(255,255,255,0)",
        "rgba(255,255,255,0)",
      ],
      gspeech_cp = ["#F0F0F0", "#3284c7", "#fc0000", "#0d7300", "#ea7d00"],
      gspeech_bca = [
        "rgba(0, 0, 0, 0.24)",
        "#3284c7",
        "#ff3333",
        "#0f8901",
        "#ea7d00",
      ],
      gspeech_ca = ["#ffffff", "#ffffff", "#ffffff", "#ffffff", "#ffffff"],
      gspeech_spop = ["90", "80", "90", "90", "90"],
      gspeech_spoa = ["100", "100", "100", "100", "100"],
      gspeech_animation_time = ["400", "400", "400", "400", "400"];
  </script>
  <script>
    $(function () {
      // Date
      $("#date_01").datepicker({
        locale: "ru-ru",
        uiLibrary: "bootstrap4",
      });

      /* на главной убрано */
      /*AOS.init({
      easing: 'ease-in-out-sine',
      disable: "mobile"
  });*/

      $(".js-tilt").tilt({
        scale: 1.05,
        glare: true,
        maxGlare: 0.2,
        speed: 500,
      });
    });
  </script>


<div class="popup-window --ui-context-content-light" id="altasib_ErrorWindow_ok" style="display: none; position: absolute; left: 0px; top: 0px; z-index: 1000 !important;"><div id="popup-window-content-altasib_ErrorWindow_ok" class="popup-window-content">        <div id="altasib_SendErrorOk">                <div width="100%" class="no-bootom-border" style="padding-top:8px !important;"><span style="color:green;font-size:20px"><b>                Sizning habaringiz yuborildi.</b></span><span style="font-size:12px;color:#7d7d7d"><br><br>E’tiboringiz uchun rahmat!</span></div>        </div></div><span class="popup-window-close-icon" style="right: 20px; top: 10px;"></span><div class="popup-window-buttons"><span class="popup-window-button webform-button-link-cancel" id="">Yopish</span></div></div><div class="popup-window-overlay" id="popup-window-overlay-altasib_ErrorWindow_ok" style="width: 462px; height: 5394px; z-index: 995 !important; background-color: black;"></div><div class="popup-window popup-window-with-titlebar --ui-context-content-light" id="altasib_ErrorWindow" style="display: none; position: absolute; left: 0px; top: 0px; z-index: 1050 !important;"><div class="popup-window-titlebar" id="popup-window-titlebar-altasib_ErrorWindow" style="cursor: move;"><div class="altasib_ErrorTitleBar"><b>Muallifga hatolik to’g’risida habar berish kerakmi?</b><br><span style="font-size: 10px; color: #7d7d7d">(brauzeringiz shu sahifada qoladi)</span></div></div><div id="popup-window-content-altasib_ErrorWindow" class="popup-window-content"><div id="send-error">        <br><span style="font-size:13px;color: #777"><b>Matndan topilgan hatolik:</b></span>        <div style="border:1px solid #d1d1d1;background-color:#fafafa;width:470px;max-width: 100%;padding:8px;margin:7px 0px 13px 0px;min-height:55px;color:#7d7d7d;font-size:12px;box-sizing:content-box;">        <span id="error_start"></span><font color="red" id="error_body"></font><span id="error_end"></span>        </div>        <small style="color:#7d7d7d">Muallif uchun mulohaza (zaruriyatda):</small>        <div style="width:470px;max-width: 100%;min-height:55px;padding:8px;border:1px solid #4b4b4b;margin:3px 0px 3px 0px;box-sizing:content-box;"><textarea name="comment" id="error-comment" rows="3" cols="5" style="width:100%;border:0px;min-height:55px;padding:0px;min-height:55px;"></textarea></div></div></div><span class="popup-window-close-icon popup-window-titlebar-close-icon" style="right: 20px; top: 10px;"></span><div class="popup-window-buttons"><span class="popup-window-button popup-window-button-accept" id="">Yuborish</span><span class="popup-window-button popup-window-button-link webform-button-link-cancel" id="">Bekor qilish</span></div></div><div class="popup-window-overlay" id="popup-window-overlay-altasib_ErrorWindow" style="width: 462px; height: 5394px; z-index: 1045 !important; background-color: black;"></div><div class="xdsoft_datetimepicker xdsoft_noselect xdsoft_"><div class="xdsoft_datepicker active"><div class="xdsoft_monthpicker"><button type="button" class="xdsoft_prev" style="visibility: visible;"></button><button type="button" class="xdsoft_today_button" style="visibility: visible;"></button><div class="xdsoft_label xdsoft_month"><span>Yanvar</span><div class="xdsoft_select xdsoft_monthselect xdsoft_scroller_box"><div style="margin-top: 0px;"><div class="xdsoft_option xdsoft_current" data-value="0">Yanvar</div><div class="xdsoft_option " data-value="1">Fevral</div><div class="xdsoft_option " data-value="2">Mart</div><div class="xdsoft_option " data-value="3">Aprel</div><div class="xdsoft_option " data-value="4">May</div><div class="xdsoft_option " data-value="5">Iyun</div><div class="xdsoft_option " data-value="6">Iyul</div><div class="xdsoft_option " data-value="7">Avgust</div><div class="xdsoft_option " data-value="8">Sentyabr</div><div class="xdsoft_option " data-value="9">Oktyabr</div><div class="xdsoft_option " data-value="10">Noyabr</div><div class="xdsoft_option " data-value="11">Dekabr</div></div><div class="xdsoft_scrollbar"><div class="xdsoft_scroller" style="height: 10px; margin-top: 0px;"></div></div></div><i></i></div><div class="xdsoft_label xdsoft_year"><span>2026</span><div class="xdsoft_select xdsoft_yearselect xdsoft_scroller_box"><div style="margin-top: 0px;"><div class="xdsoft_option " data-value="1994">1994</div><div class="xdsoft_option " data-value="1995">1995</div><div class="xdsoft_option " data-value="1996">1996</div><div class="xdsoft_option " data-value="1997">1997</div><div class="xdsoft_option " data-value="1998">1998</div><div class="xdsoft_option " data-value="1999">1999</div><div class="xdsoft_option " data-value="2000">2000</div><div class="xdsoft_option " data-value="2001">2001</div><div class="xdsoft_option " data-value="2002">2002</div><div class="xdsoft_option " data-value="2003">2003</div><div class="xdsoft_option " data-value="2004">2004</div><div class="xdsoft_option " data-value="2005">2005</div><div class="xdsoft_option " data-value="2006">2006</div><div class="xdsoft_option " data-value="2007">2007</div><div class="xdsoft_option " data-value="2008">2008</div><div class="xdsoft_option " data-value="2009">2009</div><div class="xdsoft_option " data-value="2010">2010</div><div class="xdsoft_option " data-value="2011">2011</div><div class="xdsoft_option " data-value="2012">2012</div><div class="xdsoft_option " data-value="2013">2013</div><div class="xdsoft_option " data-value="2014">2014</div><div class="xdsoft_option " data-value="2015">2015</div><div class="xdsoft_option " data-value="2016">2016</div><div class="xdsoft_option " data-value="2017">2017</div><div class="xdsoft_option " data-value="2018">2018</div><div class="xdsoft_option " data-value="2019">2019</div><div class="xdsoft_option " data-value="2020">2020</div><div class="xdsoft_option " data-value="2021">2021</div><div class="xdsoft_option " data-value="2022">2022</div><div class="xdsoft_option " data-value="2023">2023</div><div class="xdsoft_option " data-value="2024">2024</div><div class="xdsoft_option " data-value="2025">2025</div><div class="xdsoft_option xdsoft_current" data-value="2026">2026</div></div><div class="xdsoft_scrollbar"><div class="xdsoft_scroller" style="height: 10px; margin-top: 0px;"></div></div></div><i></i></div><button type="button" class="xdsoft_next" style="visibility: visible;"></button></div><div class="xdsoft_calendar"><table><thead><tr><th>Ya</th><th>Du</th><th>Se</th><th>Cho</th><th>Pa</th><th>Ju</th><th>Sha</th></tr></thead><tbody><tr><td data-date="28" data-month="11" data-year="2025" class="xdsoft_date xdsoft_day_of_week0 xdsoft_date xdsoft_other_month xdsoft_weekend" title=""><div>28</div></td><td data-date="29" data-month="11" data-year="2025" class="xdsoft_date xdsoft_day_of_week1 xdsoft_date xdsoft_other_month" title=""><div>29</div></td><td data-date="30" data-month="11" data-year="2025" class="xdsoft_date xdsoft_day_of_week2 xdsoft_date xdsoft_other_month" title=""><div>30</div></td><td data-date="31" data-month="11" data-year="2025" class="xdsoft_date xdsoft_day_of_week3 xdsoft_date xdsoft_other_month" title=""><div>31</div></td><td data-date="1" data-month="0" data-year="2026" class="xdsoft_date xdsoft_day_of_week4 xdsoft_date" title=""><div>1</div></td><td data-date="2" data-month="0" data-year="2026" class="xdsoft_date xdsoft_day_of_week5 xdsoft_date" title=""><div>2</div></td><td data-date="3" data-month="0" data-year="2026" class="xdsoft_date xdsoft_day_of_week6 xdsoft_date xdsoft_weekend" title=""><div>3</div></td></tr><tr><td data-date="4" data-month="0" data-year="2026" class="xdsoft_date xdsoft_day_of_week0 xdsoft_date xdsoft_weekend" title=""><div>4</div></td><td data-date="5" data-month="0" data-year="2026" class="xdsoft_date xdsoft_day_of_week1 xdsoft_date" title=""><div>5</div></td><td data-date="6" data-month="0" data-year="2026" class="xdsoft_date xdsoft_day_of_week2 xdsoft_date" title=""><div>6</div></td><td data-date="7" data-month="0" data-year="2026" class="xdsoft_date xdsoft_day_of_week3 xdsoft_date" title=""><div>7</div></td><td data-date="8" data-month="0" data-year="2026" class="xdsoft_date xdsoft_day_of_week4 xdsoft_date" title=""><div>8</div></td><td data-date="9" data-month="0" data-year="2026" class="xdsoft_date xdsoft_day_of_week5 xdsoft_date" title=""><div>9</div></td><td data-date="10" data-month="0" data-year="2026" class="xdsoft_date xdsoft_day_of_week6 xdsoft_date xdsoft_weekend" title=""><div>10</div></td></tr><tr><td data-date="11" data-month="0" data-year="2026" class="xdsoft_date xdsoft_day_of_week0 xdsoft_date xdsoft_weekend" title=""><div>11</div></td><td data-date="12" data-month="0" data-year="2026" class="xdsoft_date xdsoft_day_of_week1 xdsoft_date" title=""><div>12</div></td><td data-date="13" data-month="0" data-year="2026" class="xdsoft_date xdsoft_day_of_week2 xdsoft_date" title=""><div>13</div></td><td data-date="14" data-month="0" data-year="2026" class="xdsoft_date xdsoft_day_of_week3 xdsoft_date" title=""><div>14</div></td><td data-date="15" data-month="0" data-year="2026" class="xdsoft_date xdsoft_day_of_week4 xdsoft_date" title=""><div>15</div></td><td data-date="16" data-month="0" data-year="2026" class="xdsoft_date xdsoft_day_of_week5 xdsoft_date" title=""><div>16</div></td><td data-date="17" data-month="0" data-year="2026" class="xdsoft_date xdsoft_day_of_week6 xdsoft_date xdsoft_weekend" title=""><div>17</div></td></tr><tr><td data-date="18" data-month="0" data-year="2026" class="xdsoft_date xdsoft_day_of_week0 xdsoft_date xdsoft_weekend" title=""><div>18</div></td><td data-date="19" data-month="0" data-year="2026" class="xdsoft_date xdsoft_day_of_week1 xdsoft_date" title=""><div>19</div></td><td data-date="20" data-month="0" data-year="2026" class="xdsoft_date xdsoft_day_of_week2 xdsoft_date" title=""><div>20</div></td><td data-date="21" data-month="0" data-year="2026" class="xdsoft_date xdsoft_day_of_week3 xdsoft_date" title=""><div>21</div></td><td data-date="22" data-month="0" data-year="2026" class="xdsoft_date xdsoft_day_of_week4 xdsoft_date" title=""><div>22</div></td><td data-date="23" data-month="0" data-year="2026" class="xdsoft_date xdsoft_day_of_week5 xdsoft_date" title=""><div>23</div></td><td data-date="24" data-month="0" data-year="2026" class="xdsoft_date xdsoft_day_of_week6 xdsoft_date xdsoft_weekend" title=""><div>24</div></td></tr><tr><td data-date="25" data-month="0" data-year="2026" class="xdsoft_date xdsoft_day_of_week0 xdsoft_date xdsoft_weekend" title=""><div>25</div></td><td data-date="26" data-month="0" data-year="2026" class="xdsoft_date xdsoft_day_of_week1 xdsoft_date" title=""><div>26</div></td><td data-date="27" data-month="0" data-year="2026" class="xdsoft_date xdsoft_day_of_week2 xdsoft_date" title=""><div>27</div></td><td data-date="28" data-month="0" data-year="2026" class="xdsoft_date xdsoft_day_of_week3 xdsoft_date xdsoft_current" title=""><div>28</div></td><td data-date="29" data-month="0" data-year="2026" class="xdsoft_date xdsoft_day_of_week4 xdsoft_date" title=""><div>29</div></td><td data-date="30" data-month="0" data-year="2026" class="xdsoft_date xdsoft_day_of_week5 xdsoft_date" title=""><div>30</div></td><td data-date="31" data-month="0" data-year="2026" class="xdsoft_date xdsoft_day_of_week6 xdsoft_date xdsoft_weekend" title=""><div>31</div></td></tr></tbody></table></div><button type="button" class="xdsoft_save_selected blue-gradient-button" style="display: none;">Save Selected</button></div><div class="xdsoft_timepicker"><button type="button" class="xdsoft_prev"></button><div class="xdsoft_time_box xdsoft_scroller_box"><div class="xdsoft_time_variant" style="margin-top: 0px;"><div class="xdsoft_time xdsoft_current" data-hour="0" data-minute="0">00:00</div><div class="xdsoft_time " data-hour="1" data-minute="0">01:00</div><div class="xdsoft_time " data-hour="2" data-minute="0">02:00</div><div class="xdsoft_time " data-hour="3" data-minute="0">03:00</div><div class="xdsoft_time " data-hour="4" data-minute="0">04:00</div><div class="xdsoft_time " data-hour="5" data-minute="0">05:00</div><div class="xdsoft_time " data-hour="6" data-minute="0">06:00</div><div class="xdsoft_time " data-hour="7" data-minute="0">07:00</div><div class="xdsoft_time " data-hour="8" data-minute="0">08:00</div><div class="xdsoft_time " data-hour="9" data-minute="0">09:00</div><div class="xdsoft_time " data-hour="10" data-minute="0">10:00</div><div class="xdsoft_time " data-hour="11" data-minute="0">11:00</div><div class="xdsoft_time " data-hour="12" data-minute="0">12:00</div><div class="xdsoft_time " data-hour="13" data-minute="0">13:00</div><div class="xdsoft_time " data-hour="14" data-minute="0">14:00</div><div class="xdsoft_time " data-hour="15" data-minute="0">15:00</div><div class="xdsoft_time " data-hour="16" data-minute="0">16:00</div><div class="xdsoft_time " data-hour="17" data-minute="0">17:00</div><div class="xdsoft_time " data-hour="18" data-minute="0">18:00</div><div class="xdsoft_time " data-hour="19" data-minute="0">19:00</div><div class="xdsoft_time " data-hour="20" data-minute="0">20:00</div><div class="xdsoft_time " data-hour="21" data-minute="0">21:00</div><div class="xdsoft_time " data-hour="22" data-minute="0">22:00</div><div class="xdsoft_time " data-hour="23" data-minute="0">23:00</div></div><div class="xdsoft_scrollbar"><div class="xdsoft_scroller" style="height: 10px; margin-top: 0px;"></div></div></div><button type="button" class="xdsoft_next"></button></div></div></body></html>