<?php
/**
* @version $Id: bulgarian.php,v 1.0.9a 07.06.2006 by Imago Exp $
* based on v 1.0. 25.02.2006 19:31:10 ivoapostolov
* @package Joomla! Bulgarian
* @copyright (C) 2005 Joomla! Bulgaria
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Joomla is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Директният достъп е забранен!' );

// Site page note found
define( '_404', 'Извинете, страницата, която търсите, не съществува.' );
define( '_404_RTS', 'Назад към сайта' );

/** common */
DEFINE('_CONTACT_ONE_EMAIL','Въведете само един имейл адрес.');
DEFINE('_LANGUAGE','bg');
DEFINE('_NOT_AUTH','Нямате нужните права, за да разглеждате този ресурс.');
DEFINE('_DO_LOGIN','Трябва да се авторизирате като потребител.');
DEFINE('_VALID_AZ09','Въведете валидна %s. Без интервали, повече от %d символа: 0-9,a-z,A-Z');
DEFINE('_CMN_YES','Да');
DEFINE('_CMN_NO','Не');
DEFINE('_CMN_SHOW','Покажи');
DEFINE('_CMN_HIDE','Скрий');
DEFINE('_CMN_NEW_ITEM_LAST','Новите - последни'); 
DEFINE('_PN_LT','&lt;');
DEFINE('_PN_RT','&gt;');
DEFINE('_CMN_NAME','Име');
DEFINE('_CMN_DESCRIPTION','Описание');
DEFINE('_CMN_SAVE','Запис');
DEFINE('_CMN_CANCEL','Отказ');
DEFINE('_CMN_PRINT','Печат');
DEFINE('_CMN_PDF','PDF');
DEFINE('_CMN_EMAIL','Имейл');
DEFINE('_ICON_SEP','|');
DEFINE('_CMN_PARENT','Горен'); // in the context of parent folder, parent menu item, etc
DEFINE('_CMN_ORDERING','Сортиране');
DEFINE('_CMN_ACCESS','Ниво на достъп');
DEFINE('_CMN_SELECT','Избор');
DEFINE('_SEARCH_CATBLOG','Блог на категория');
DEFINE('_CMN_NEXT','Напред');
DEFINE('_CMN_NEXT_ARROW','&gt;&gt;');
DEFINE('_CMN_PREV','Назад');
DEFINE('_CMN_PREV_ARROW','&lt;&lt;');

DEFINE('_CMN_SORT_NONE','без сортиране');
DEFINE('_CMN_SORT_ASC','възходящ ред');
DEFINE('_CMN_SORT_DESC','низходящ ред');

DEFINE('_CMN_NEW','Нова');
DEFINE('_CMN_NONE','Няма');
DEFINE('_CMN_LEFT','Ляво');
DEFINE('_CMN_RIGHT','Дясно');
DEFINE('_CMN_CENTER','Център');
DEFINE('_CMN_ARCHIVE','Архив');
DEFINE('_CMN_UNARCHIVE','Извади от архива');
DEFINE('_CMN_TOP','Горе');
DEFINE('_CMN_BOTTOM','Долу');

DEFINE('_CMN_PUBLISHED','Публикувана');
DEFINE('_CMN_UNPUBLISHED','Непубликувана');

DEFINE('_CMN_EDIT_HTML','Редактирай HTML');
DEFINE('_CMN_EDIT_CSS','Редактирай CSS');

DEFINE('_CMN_DELETE','Изтрий');

DEFINE('_CMN_FOLDER','Директория');
DEFINE('_CMN_SUBFOLDER','Поддиректория');
DEFINE('_CMN_OPTIONAL','Не е задължително');
DEFINE('_CMN_REQUIRED','Задължително');

DEFINE('_CMN_CONTINUE','Продължи');

DEFINE('_CMN_NEW_ITEM','Новите обекти на последно място');
DEFINE('_CMN_NEW_ITEM_FIRST','Новите обекти на първо място');
DEFINE('_LOGIN_INCOMPLETE','Моля, въведете потребителско име и парола.');
DEFINE('_LOGIN_BLOCKED','Потребителското Ви име е блокирано. Моля, свържете се с администратор.');
DEFINE('_LOGIN_INCORRECT','Невалидно потребителско име или парола. Опитайте отново.');
DEFINE('_LOGIN_NOADMINS','Не може да влезете. Липсва администратор!');
DEFINE('_CMN_JAVASCRIPT','Внимание! Тази операция изисква Javascript.');

DEFINE('_NEW_MESSAGE','Получено е ново лично съобщение');
DEFINE('_MESSAGE_FAILED','Потребителят е заключил пощенската си кутия. Съобщението не е получено.');

DEFINE('_CMN_IFRAMES', 'Тази опция няма да работи коректно. За съжаление Вашият браузер не поддържа Inline Frames.');

DEFINE('_INSTALL_WARN','За по-сигурно изтрийте директория installation и после презаредете тази страница');
DEFINE('_TEMPLATE_WARN','<font color=\"red\"><b>Шаблонът не е намерен!</b></font><br />Правили ли сте обновяване? <br />Ако да, <b>ТРЯБВА</b> да обновите и база данните си.<br />Влезте в администрацията, за да обновите база данните.');
DEFINE('_NO_PARAMS','Няма параметри за този модул');
DEFINE('_HANDLER','Не е определен типът инструмент');

/** mambots */
DEFINE('_TOC_JUMPTO','Съдържание на статията');

/** PDF */
DEFINE('_PDF_GENERATED','Генерирано от');
DEFINE('_PDF_POWERED','Създадено с Joomla!');


/**  content */
DEFINE('_READ_MORE','Пълен текст...');
DEFINE('_READ_МОRЕ_REGISTER','Пълният текст на статията е достъпен само за регистрирани потребители...');
DEFINE('_MORE','Още...');
DEFINE('_ON_NEW_CONTENT', 'Ново съдържание, предложено от %s, със заглавие %s.' );
DEFINE('_SEL_CATEGORY','- Изберете категория -');
DEFINE('_SEL_SECTION','- Изберете секция -');
DEFINE('_SEL_AUTHOR','- Изберете автор -');
DEFINE('_SEL_POSITION','- Изберете позиция -');
DEFINE('_SEL_TYPE','- Изберете тип -');
DEFINE('_EMPTY_CATEGORY','Тази категория е празна');
DEFINE('_EMPTY_BLOG','Няма статии в тази категория');
DEFINE('_NOT_EXIST','Страницата, която се опитвате да отворите, не съществува.<br />Моля, изберете страница от менюто.');

/** classes/html/modules.php */
DEFINE('_BUTTON_VOTE','Гласуване');
DEFINE('_BUTTON_RESULTS','Резултати');
DEFINE('_USERNAME','Потребител');
DEFINE('_LOST_PASSWORD','Забравена парола');
DEFINE('_PASSWORD','Парола');
DEFINE('_BUTTON_LOGIN','Влез');
DEFINE('_BUTTON_LOGOUT','Излез');
DEFINE('_NO_ACCOUNT','Нямате акаунт?');
DEFINE('_CREATE_ACCOUNT','Регистрирайте се!');
DEFINE('_VOTE_POOR','Слабо');
DEFINE('_VOTE_BEST','Отлично');
DEFINE('_USER_RATING','Оценка');
DEFINE('_RATE_BUTTON','Оцени');
DEFINE('_REMEMBER_ME','Запомни ме');

/** contact.php */
DEFINE('_ENQUIRY','Запитване');
DEFINE('_ENQUIRY_TEXT','Това е формуляр за актуални въпроси.');
DEFINE('_COPY_TEXT','Това е копие от съобщение, изпратено до %s от %s. ');
DEFINE('_COPY_SUBJECT','Копие: ');
DEFINE('_THANK_MESSAGE','Благодарим Ви за Вашето съобщение!');
DEFINE('_CLOAKING','Този имейл адрес е защитен от спам ботове, нужна е Javascript поддръжка, за да го видите.');
DEFINE('_CONTACT_HEADER_NAME','Име');
DEFINE('_CONTACT_HEADER_POS','Позиция');
DEFINE('_CONTACT_HEADER_EMAIL','Имейл');
DEFINE('_CONTACT_HEADER_PHONE','Телефон');
DEFINE('_CONTACT_HEADER_FAX','Факс');
DEFINE('_CONTACTS_DESC','За контакти с авторите на този сайт.');

/** classes/html/contact.php */
DEFINE('_CONTACT_TITLE','Контакти');
DEFINE('_EMAIL_DESCRIPTION','Моля, опишете проблема, който срещате:');
DEFINE('_NAME_PROMPT',' Вашето име:');
DEFINE('_EMAIL_PROMPT',' Имейл адрес:');
DEFINE('_MESSAGE_PROMPT',' Вашето съобщение:');
DEFINE('_SEND_BUTTON','Изпрати');
DEFINE('_CONTACT_FORM_NC','Уверете се, че формулярът е надлежно попълнен и данните са валидни.');
DEFINE('_CONTACT_TELEPHONE','Телефон: ');
DEFINE('_CONTACT_MOBILE','Мобилен: ');
DEFINE('_CONTACT_FAX','Факс: ');
DEFINE('_CONTACT_EMAIL','Имейл: ');
DEFINE('_CONTACT_NAME','Име: ');
DEFINE('_CONTACT_POSITION','Позиция: ');
DEFINE('_CONTACT_ADDRESS','Адрес: ');
DEFINE('_CONTACT_MISC','Информация: ');
DEFINE('_CONTACT_SEL','Изберете лице за контакт:');
DEFINE('_CONTACT_NONE','Няма списък с лица за контакти.');
DEFINE('_EMAIL_A_COPY','Изпрати копие от този мейл на моя адрес!');
DEFINE('_CONTACT_DOWNLOAD_AS','Свали контактната информация');
DEFINE('_VCARD','Визитка');

/** pageNavigation */
DEFINE('_PN_PAGE','Страница');
DEFINE('_PN_OF','от');
DEFINE('_PN_START','Първа');
DEFINE('_PN_PREVIOUS','Предишна');
DEFINE('_PN_NEXT','Следваща');
DEFINE('_PN_END','Последна');
DEFINE('_PN_DISPLAY_NR','Показвай №');
DEFINE('_PN_RESULTS','Резултати');

/** emailfriend */
DEFINE('_EMAIL_TITLE','Изпрати на приятел');
DEFINE('_EMAIL_FRIEND','Изпрати на приятел.');
DEFINE('_EMAIL_FRIEND_ADDR','Имейл на получателя:');
DEFINE('_EMAIL_YOUR_NAME','Вашето име:');
DEFINE('_EMAIL_YOUR_MAIL','Вашият имейл:');
DEFINE('_SUBJECT_PROMPT',' Тема:');
DEFINE('_BUTTON_SUBMIT_MAIL','Изпрати');
DEFINE('_BUTTON_CANCEL','Отказ');
DEFINE('_EMAIL_ERR_NOINFO','Трябва да въведете валиден имейл - Ваш и на получателя.');
DEFINE('_EMAIL_MSG',' Тази страница от сайта "%s" е изпратена от %s ( %s ).

Можете да я отворите от тук: %s');
DEFINE('_EMAIL_INFO','Изпратено от');
DEFINE('_EMAIL_SENT','Изпратено до');
DEFINE('_PROMPT_CLOSE','Затвори');

/** classes/html/content.php */
DEFINE('_AUTHOR_BY', ' Автор');
DEFINE('_WRITTEN_BY', ' Автор');
DEFINE('_LAST_UPDATED', 'Последна промяна');
DEFINE('_BACK','[назад]');
DEFINE('_LEGEND','Легенда');
DEFINE('_DATE','Дата');
DEFINE('_ORDER_DROPDOWN','Сортиране');
DEFINE('_HEADER_TITLE','Заглавие');
DEFINE('_HEADER_AUTHOR','Автор');
DEFINE('_HEADER_SUBMITTED','Изпратен');
DEFINE('_HEADER_HITS','Видян');
DEFINE('_E_EDIT','Редактирай');
DEFINE('_E_ADD','Добави');
DEFINE('_E_WARNUSER','Моля, натиснете Отказ или Запишете промените!');
DEFINE('_E_WARNTITLE','Липсва заглавие');
DEFINE('_E_WARNTEXT','Липсва въвеждащ текст');
DEFINE('_E_WARNCAT','Моля, изберете категория!');
DEFINE('_E_CONTENT','Съдържание');
DEFINE('_E_TITLE','Заглавие:');
DEFINE('_E_CATEGORY','Категория:');
DEFINE('_E_INTRO','Уводен текст:<br />(задълж.)');
DEFINE('_E_MAIN','Основен текст:<br />(по желание)');
DEFINE('_E_MOSIMAGE','Вмъкни {mosimage}');
DEFINE('_E_IMAGES','Картинки');
DEFINE('_E_GALLERY_IMAGES','от галерия');
DEFINE('_E_CONTENT_IMAGES','от съдържанието');
DEFINE('_E_EDIT_IMAGE','Редактирай картинка');
DEFINE('_E_INSERT','Вмъкни');
DEFINE('_E_UP','Нагоре');
DEFINE('_E_DOWN','Надолу');
DEFINE('_E_REMOVE','Премахни');
DEFINE('_E_SOURCE','Източник:');
DEFINE('_E_ALIGN','Подравняване:');
DEFINE('_E_ALT','Алтернативен текст:');
DEFINE('_E_BORDER','Рамка:');
DEFINE('_E_APPLY','Приложи');
DEFINE('_E_PUBLISHING','Публикуване');
DEFINE('_E_STATE','Състояние:');
DEFINE('_E_AUTHOR_ALIAS','Псевдоним:');
DEFINE('_E_ACCESS_LEVEL','Ниво на достъп:');
DEFINE('_E_ORDERING','Подреждане:');
DEFINE('_E_START_PUB','Начална дата:');
DEFINE('_E_FINISH_PUB','Крайна дата:');
DEFINE('_E_SHOW_FP','Покажи на главната страница:');
DEFINE('_E_HIDE_TITLE','Не показвай заглавие:');
DEFINE('_E_METADATA','Метаданни');
DEFINE('_E_M_DESC','Описание:');
DEFINE('_E_M_KEY','Ключови думи:');
DEFINE('_E_SUBJECT','Относно:');
DEFINE('_E_EXPIRES','Краен срок:');
DEFINE('_E_VERSION','Версия:');
DEFINE('_E_ABOUT','Относно');
DEFINE('_E_CREATED','Създаден:');
DEFINE('_E_LAST_MOD','Последна промяна:');
DEFINE('_E_HITS','Видян:');
DEFINE('_E_SAVE','Запиши');
DEFINE('_E_CANCEL','Отказ');
DEFINE('_E_REGISTERED','Само за регистрирани потребители');
DEFINE('_E_ITEM_INFO','Информация');
DEFINE('_E_ITEM_SAVED','Записът е успешен.');
DEFINE('_ITEM_PREVIOUS','&lt; Предишен');
DEFINE('_ITEM_NEXT','Следващ &gt;');


/** content.php */
DEFINE('_SECTION_ARCHIVE_EMPTY','Няма архиви за тази секция, проверете по-късно.');
DEFINE('_CATEGORY_ARCHIVE_EMPTY','Няма архиви за тази категория, проверете по-късно.');
DEFINE('_HEADER_SECTION_ARCHIVE','Секционни архиви');
DEFINE('_HEADER_CATEGORY_ARCHIVE','Категорийни архиви');
DEFINE('_ARCHIVE_SEARCH_FAILURE','Няма архиви за %s %s.');	// values are month then year
DEFINE('_ARCHIVE_SEARCH_SUCCESS','Няма архиви за %s %s.');	// values are month then year
DEFINE('_FILTER','Филтър');
DEFINE('_ORDER_DROPDOWN_DA','Дата възх.');
DEFINE('_ORDER_DROPDOWN_DD','Дата низх.');
DEFINE('_ORDER_DROPDOWN_TA','Загл. възх.');
DEFINE('_ORDER_DROPDOWN_TD','Загл. низх.');
DEFINE('_ORDER_DROPDOWN_HA','Посещ. възх.');
DEFINE('_ORDER_DROPDOWN_HD','Посещ. низх.');
DEFINE('_ORDER_DROPDOWN_AUA','Автор възх.');
DEFINE('_ORDER_DROPDOWN_AUD','Автор низх.');
DEFINE('_ORDER_DROPDOWN_O','Сортиране');

/** poll.php */
DEFINE('_ALERT_ENABLED','Разрешете бисквитките в браузъра!');
DEFINE('_ALREADY_VOTE','Вие сте гласували в тази анкета!');
DEFINE('_NO_SELECTION','Не сте избрали нищо! Опитайте пак.');
DEFINE('_THANKS','Благодарим Ви, че гласувахте!');
DEFINE('_SELECT_POLL','Изберете анкета от списъка:');

/** classes/html/poll.php */
DEFINE('_JAN','Януари');
DEFINE('_FEB','Февруари');
DEFINE('_MAR','Март');
DEFINE('_APR','Април');
DEFINE('_MAY','Май');
DEFINE('_JUN','Юни');
DEFINE('_JUL','Юли');
DEFINE('_AUG','Август');
DEFINE('_SEP','Септември');
DEFINE('_OCT','Октомври');
DEFINE('_NOV','Ноември');
DEFINE('_DEC','Декември');
DEFINE('_POLL_TITLE','Анкета - Резултати');
DEFINE('_SURVEY_TITLE','Анкета:');
DEFINE('_NUM_VOTERS','Брой гласували:');
DEFINE('_FIRST_VOTE','Първо гласуване:');
DEFINE('_LAST_VOTE','Последно гласуване:');
DEFINE('_SEL_POLL','Изберете анкета:');
DEFINE('_NO_RESULTS','Няма резултати за тази анкета.');

/** registration.php */
DEFINE('_ERROR_PASS','Извинете, няма намерен потребител.');
DEFINE('_NEWPASS_MSG','Потребителят $checkusername е свързан с този имейл.\n'
.'Потребител от $mosConfig_live_site е поискал смяна на парола.\n\n'
.' Вашата нова парола е: $newpass\n\nАко не сте искали нова парола, не се притеснявайте.'
.' Никой освен Вас не чете това съобщение. Ако то е грешка, влезте с Вашата'
.' нова парола и я променете както желаете.');
DEFINE('_NEWPASS_SUB','$_sitename :: Нова парола за $checkusername');
DEFINE('_NEWPASS_SENT','Новата потребителска парола е създадена и изпратена!');
DEFINE('_REGWARN_NAME','Въведете Вашето име.');
DEFINE('_REGWARN_UNAME','Въведете Потребител.');
DEFINE('_REGWARN_MAIL','Въведете валиден имейл адрес.');
DEFINE('_REGWARN_PASS','Въведете парола. Без интервали, повече от 6 символа: 0-9,a-z,A-Z');
DEFINE('_REGWARN_VPASS1','Моля, потвърдете паролата.');
DEFINE('_REGWARN_VPASS2','Паролата и потвърждението не съвпадат, опитайте пак.');
DEFINE('_REGWARN_INUSE','Този потребител/парола се използва. Опитайте нещо друго.');
DEFINE('_REGWARN_EMAIL_INUSE', "Този имейл е вече регистриран. Ако сте забравили Вашата парола, натиснете линка 'Забравена парола' и ще Ви бъде изпратена нова.");
DEFINE('_SEND_SUB','Детайли за %s от сайта на %s');
DEFINE('_USEND_MSG_ACTIVATE', 'Здравейте, %s!

Благодарим Ви, че се регистрирахте като член на %s. Вашият акаунт е създаден и трябва да бъде активиран, преди да започнете да го ползвате.
За да го активирате, натиснете посочения линк или го копирайте в адресното поле на Вашия браузер.
%s

След активиране може да влезете в %s, използвайки следното потребителско име и парола:

Потребител - %s
Парола - %s');
DEFINE('_USEND_MSG', 'Здравейте, %s!

Благодарим Ви, че се регистрирахте в %s.

Може да влезете в %s, използвайки потребителското име и паролата, с които сте се регистрирали.');
DEFINE('_USEND_MSG_NOPASS','Здравейте, $name!\n\nВие се регистрирахте като потребител в $mosConfig_live_site.\n'
.'Може да влезете в $mosConfig_live_site с потребителското име и паролата, с които сте се регистрирали.\n\n'
.'Моля, не отговаряйте на това писмо, тъй като то е автоматично генерирано единствено и само за Ваша информация.\n');
DEFINE('_ASEND_MSG','Здравейте, %s!

Нов потребител е регистриран в база данните на %s.
Този мейл съдържа неговите детайли:

Име - %s
Имейл - %s
Потребител - %s

Моля, не отговаряйте на това писмо, тъй като то е генерирано автоматично.');
DEFINE('_REG_COMPLETE_NOPASS','<div class="componentheading">Регистрацията завърши!</div><br />&nbsp;&nbsp;'
.'Вече може да влизате в акаунта си.<br />&nbsp;&nbsp;');
DEFINE('_REG_COMPLETE', '<div class="componentheading">Регистрацията приключи!</div><br />Сега може да влезете.');
DEFINE('_REG_COMPLETE_ACTIVATE', '<div class="componentheading">Регистрацията приключи!</div><br />Вашият профил е създаден, а съответният линк за активиране ще бъде изпратен в близките минути на въведения от Вас адрес. Не забравяйте да активирате акаунта си, като посетите съдържащата се в писмото препратка.');
DEFINE('_REG_ACTIVATE_COMPLETE', '<div class="componentheading">Активацията приключи!</div><br />Вашият акаунт е активиран. Сега може да влезете, използвайки потребителското име и паролата, които сте избрали при регистрацията.');
DEFINE('_REG_ACTIVATE_NOT_FOUND', '<div class="componentheading">Невалидна активационна препратка!</div><br />Няма такъв потребител в нашата база данни или потребителят е вече активиран по друга линия.');

/** classes/html/registration.php */
DEFINE('_PROMPT_PASSWORD','Забравена парола?');
DEFINE('_NEW_PASS_DESC','Въведете вашето потребителско име и имейл, а след това натиснете бутона Изпрати Парола.<br />'
.'Ще получите на имейла си нова парола. Използвайте я за достъп.');
DEFINE('_PROMPT_UNAME','Потребител:');
DEFINE('_PROMPT_EMAIL','Имейл адрес:');
DEFINE('_BUTTON_SEND_PASS','Изпрати Парола');
DEFINE('_REGISTER_TITLE','Регистрация');
DEFINE('_REGISTER_NAME','Име:');
DEFINE('_REGISTER_UNAME','Потребител:');
DEFINE('_REGISTER_EMAIL','Имейл:');
DEFINE('_REGISTER_PASS','Парола:');
DEFINE('_REGISTER_VPASS','Потвърждение:');
DEFINE('_REGISTER_REQUIRED','Полетата, маркирани с [*], са задължителни.');
DEFINE('_BUTTON_SEND_REG','Изпрати регистрацията');
DEFINE('_SENDING_PASSWORD','Вашата парола ще бъде изпратена на посочения адрес. След като я получите, може да влезете в сайта и да я промените.');

/** classes/html/search.php */
DEFINE('_SEARCH_TITLE','Търсене');
DEFINE('_PROMPT_KEYWORD','Ключова дума:');
DEFINE('_SEARCH_MATCHES','намерени %d съвпадения');
DEFINE('_CONCLUSION','Общо намерени $totalRows резултати. Търси за <b>$searchword</b> с');
DEFINE('_NOKEYWORD','Няма резултати');
DEFINE('_IGNOREKEYWORD','Някои думи не са взети под внимание при търсенето.');
DEFINE('_SEARCH_ANYWORDS','Която и да е дума');
DEFINE('_SEARCH_ALLWORDS','Всички думи');
DEFINE('_SEARCH_PHRASE','Точна фраза');
DEFINE('_SEARCH_NEWEST','Първо новите');
DEFINE('_SEARCH_OLDEST','Първо старите');
DEFINE('_SEARCH_POPULAR','Най-популярните');
DEFINE('_SEARCH_ALPHABETICAL','По азбучен ред');
DEFINE('_SEARCH_CATEGORY','Раздел/Категория');
DEFINE('_SEARCH_MESSAGE','Думата за търсене трябва да бъде минимум 3 и максимум 20 символа.');
DEFINE('_SEARCH_ARCHIVED','Архив');
DEFINE('_SEARCH_CATLIST','Списък с категории');
DEFINE('_SEARCH_NEWSFEEDS','Външни новини');
DEFINE('_SEARCH_SECLIST','Списък с раздели');
DEFINE('_SEARCH_SECBLOG','Блог на раздел');

/** templates/*.php */
DEFINE('_ISO','charset=UTF-8');
DEFINE('_DATE_FORMAT','l, F d Y');  //Uses PHP's DATE Command Format - Depreciated
/**
* Modify this line to reflect how you want the date to appear in your site
*
*e.g. DEFINE("_DATE_FORMAT_LC","%A, %d %B %Y %H:%M"); //Uses PHP's strftime Command Format
*/
DEFINE('_DATE_FORMAT_LC','%A, %d %B %Y'); //Uses PHP's strftime Command Format
DEFINE('_DATE_FORMAT_LC2','%A, %d %B %Y %H:%M');
DEFINE('_SEARCH_BOX','търсене...');
DEFINE('_NEWSFLASH_BOX','Горещи новини!');
DEFINE('_MAINMENU_BOX','Главно меню');

/** classes/html/usermenu.php */
DEFINE('_UMENU_TITLE','Потребителско меню');
DEFINE('_HI','Здравейте, ');

/** user.php */
DEFINE('_SAVE_ERR','Моля, попълнете всички полета.');
DEFINE('_THANK_SUB','Благодарим Ви!\\nПредоставената от Вас информация ще бъде прегледана от администратора, преди да бъде публикувана.');
DEFINE('_UP_SIZE','Не може да качвате файлове по-големи от 15kb.');
DEFINE('_UP_EXISTS','Картинка с име $userfile_name вече съществува. Моля, преименувайте файла и опитайте пак.');
DEFINE('_UP_COPY_FAIL','Грешка при копиране');
DEFINE('_UP_TYPE_WARN','Може да зареждате само gif или jpg изображения.');
DEFINE('_MAIL_SUB','Нов материал от потребител');
DEFINE('_MAIL_MSG','Здравей, $adminName!\n\nНов материал - $type, $title - е предложен за публикуване от $author'
.' за $mosConfig_live_site сайт.\n'
.'Моля, влезте в $mosConfig_live_site/administrator, за да прегледате и разрешите публикуването на $type.\n\n'
.'Моля, не отговаряйте на това писмо, тъй като то е генерирано автоматично, само за Ваша информация\n');
DEFINE('_PASS_VERR1','Ако сменяте паролата си, моля, въведете я отново за проверка.');
DEFINE('_PASS_VERR2','Ако сменяте паролата си, моля, убедете се, че новата парола и потвърждението й съвпадат.');
DEFINE('_UNAME_INUSE','Това потребителско име е заето.');
DEFINE('_UPDATE','Обнови');
DEFINE('_USER_DETAILS_SAVE','Вашите детайли са записани.');
DEFINE('_USER_LOGIN','Потребителски вход');

/** components/com_user */
DEFINE('_EDIT_TITLE','Редактиране');
DEFINE('_YOUR_NAME','Вашето име:');
DEFINE('_EMAIL','Имейл:');
DEFINE('_UNAME','Потребителско име:');
DEFINE('_PASS','Парола:');
DEFINE('_VPASS','Потвърждение на парола:');
DEFINE('_SUBMIT_SUCCESS','Благодарим Ви!');
DEFINE('_SUBMIT_SUCCESS_DESC','Вашето предложение е изпратено на администратора. То ще бъде прегледано и евентуално публикувано, ако отговаря на нашите условия.');
DEFINE('_THANK_SUB_PUB','Благодарим Ви за добавения материал.');
DEFINE('_WELCOME','Добре дошли!');
DEFINE('_WELCOME_DESC','Добре дошли в раздела за членове.');
DEFINE('_CONF_CHECKED_IN','Всички статии са заключени');
DEFINE('_CHECK_TABLE','Проверка на таблици');
DEFINE('_CHECKED_IN','Проверени ');
DEFINE('_CHECKED_IN_ITEMS',' статии');
DEFINE('_PASS_MATCH','Паролите не съвпадат');

/** components/com_banners */
DEFINE('_BNR_CLIENT_NAME','Трябва да изберете име за клиент.');
DEFINE('_BNR_CONTACT','Трябва да изберете контактно лице за клиент.');
DEFINE('_BNR_VALID_EMAIL','Трябва да изберете имейл за клиент.');
DEFINE('_BNR_CLIENT','Трябва да изберете клиент.');
DEFINE('_BNR_NAME','Трябва да изберете име за банер.');
DEFINE('_BNR_IMAGE','Трябва да изберете картинка за банер.');
DEFINE('_BNR_URL','Трябва да изберете URL/код за банера.');

/** components/com_login */
DEFINE('_ALREADY_LOGIN','Вече сте влезли!');
DEFINE('_LOGOUT','Натиснете тук за изход');
DEFINE('_LOGIN_TEXT','Използвайте потребителското си име и парола, за да получите пълен достъп.');
DEFINE('_LOGIN_SUCCESS','Влязохте успешно');
DEFINE('_LOGOUT_SUCCESS','Излязохте успешно');
DEFINE('_LOGIN_DESCRIPTION','Въведете своето име и парола, за да получите достъп до разрешените за членове раздели и публикации.');
DEFINE('_LOGOUT_DESCRIPTION','В момента Вие се намирате в раздела за членове на нашия сайт.');


/** components/com_weblinks */
DEFINE('_WEBLINKS_TITLE','Препратки');
DEFINE('_WEBLINKS_DESC','Тук ще намерите препратки към интересни места в Интернет.'
.' насладете се.  <br />Изберете тема от списъка, след това натиснете препратката към страницата, която ви интересува.');
DEFINE('_HEADER_TITLE_WEBLINKS','Линкомат');
DEFINE('_SECTION','Раздел:');
DEFINE('_SUBMIT_LINK','Добави препратка');
DEFINE('_URL','URL:');
DEFINE('_URL_DESC','Описание:');
DEFINE('_NAME','Име:');
DEFINE('_WEBLINK_EXIST','Има препратка със същото име! Опитайте отново.');
DEFINE('_WEBLINK_TITLE','Заглавието е задължително!');

/** components/com_newfeeds */
DEFINE('_FEED_NAME','Име на RSS източника');
DEFINE('_FEED_ARTICLES','Брой статии');
DEFINE('_FEED_LINK','Адрес на RSS източника');

/** whos_online.php */
DEFINE('_WE_HAVE', 'В момента на сайта има ');
DEFINE('_AND', ' и ');
DEFINE('_GUEST_COUNT','%s гост');
DEFINE('_GUESTS_COUNT','%s гости');
DEFINE('_MEMBER_COUNT','%s потребител');
DEFINE('_MEMBERS_COUNT','%s потребителя');
DEFINE('_ONLINE',' онлайн');
DEFINE('_NONE','Няма потребители онлайн');

/** modules/mod_stats.php */
DEFINE('_TIME_STAT','Време');
DEFINE('_MEMBERS_STAT','Потребители');
DEFINE('_HITS_STAT','Посещения');
DEFINE('_NEWS_STAT','Новини');
DEFINE('_LINKS_STAT','Връзки');
DEFINE('_VISITORS','Посетители');

/** /adminstrator/components/com_menus/admin.menus.html.php */
DEFINE('_MAINMENU_HOME','* Първата публикувана препратка в това меню [mainmenu] е по подразбиране `Начало` за сайта. *');
DEFINE('_MAINMENU_DEL','* Не може да изтриете това меню - то е нужно за правилната работа на Joomla! *');
DEFINE('_MENU_GROUP','* Някои видове меню се появяват в повече от една група. *');
DEFINE('_VALID_AZ09_USER','Моля, въведете валиден %s. Повече от %d символа, които да съдържат символи от типа 0-9,a-z,A-Z.');
DEFINE('_CMN_APPLY','Приложи');
DEFINE('_STATIC_CONTENT','Статично съдържание');
DEFINE('_CONTACT_MORE_THAN','Може да въведете само едно лице за контакт.');
DEFINE('_CONTACT_ONE_EMAIL','Може да въведете само един имейл адрес.');
DEFINE('_E_NO_IMAGE','Няма изображение');
DEFINE('_E_CAPTION','Обяснение към снимка');
DEFINE('_E_CAPTION_POSITION','Позиция');
DEFINE('_E_CAPTION_ALIGN','Подравняване');
DEFINE('_E_CAPTION_WIDTH','Ширина');
DEFINE('_KEY_NOT_FOUND','Няма намерен ключ');
DEFINE('_NO_IMAGES','Няма картинки');

/** administrators/components/com_users */
DEFINE('_NEW_USER_MESSAGE_SUBJECT', 'Детайли за нов потребител' );
DEFINE('_NEW_USER_MESSAGE', 'Здравейте, %s!

Бяхте добавен/а като потребител %s от администратора.

Този имейл съдържа Вашето потребителско име и парола за влизане в %s:

Потребител - %s
Парола - %s


Моля, не отговаряйте на това писмо, то е автоматично генерирано единствено и само за Ваша информация.');

/** administrators/components/com_massmail */
DEFINE('_MASSMAIL_MESSAGE', "Това е имейл от '%s'

Съобщение:
" );

?>