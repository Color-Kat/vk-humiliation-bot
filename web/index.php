<?php

require('../vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => 'php://stderr',
));
$app->get('/', function () use ($app) {
    return 'heroku is the bad hosting';
});

$app->post('/bot', function () use ($app) {
    $data = json_decode(file_get_contents('php://input'));

    if (!$data) return 'nioh';

    if (
        $data->secret !== getenv('VK_SECRET_TOKEN') &&
        $data->type !== 'confirmation'
    ) return 'nioh';

    switch ($data->type) {
        case 'confirmation':
            return getenv('VK_CONFIRMATION_CODE');

        case 'message_new':
            // create response array
            $request_params = [
                'user_id' => $data->object->user_id,
                'message' => 'лошара',
                'access_token' => getenv('VK_TOKEN'),
                'v' => '5.80'
            ];

            // insults list
            $insults = [
                'лох',
                'лошара',
                'лашпед',
                'петух',
                'петушара',
                'петя',
                'собака',
                'хохол',
                'животное',
                'животина',
                'скотина',
                'леший',
                'дед',
                'пердун',
                'дед-пердун',
                'запердыш',
                'засерыш',
                'урод',
                'урод',
                'дурак',
                'дебил',
                'дебилойд',
                'уродец',
                'гад',
                'огурец',
                'падла',
                'мусор',
                'тупица',
                'тупой',
                'срань',
                'засранец',
                'засранец',
                'свинья',
                'жертва оборта',
                'жертва оборта',
                'высер',
                'сцыкун',
                'гад ползучий',
                'гад ползучий',
                'скупердяй',
                'жадоба',
                'алочный',
                'тупой',
                'глупый',
                'идиот',
                'даун',
                'гей',
                'трансгендер',
                'фашист',
                'ОЛЕГ',
                'перфаратор',
                'паразит',
                'предатель',
                'горе',
                'Олег',
                'БОМЖ',
                'БОМЖара',
                'алкаш',
                'наркоман',
                'нарик',
                'торчок',
                'абобус',
                'абобус',
                'даша корейка',
                'скот',
                'палено',
                'бревно',
                'пень',
                'обосрался',
                'обосрался',
                'в говне',
                'в моче',
                'сусыня',
                'негр',
                'нигер',
                'барыга?',
                'очкобус',
                'страшный',
                'очконавт',
                'старпер',
                'баба',
                'Люся',
                'больной',
                'псих',
                'быдло',
                'старик',
                'нищий',
                'тварь',
                'тварина',
                'слабак',
                'черт',
                'чорт',
                'чертила',
                'чертище',
                'ЧЕРТопоЛОХ',
                'черт',
                'черный черт',
                'кобан',
                'хулиган',
                'свин',
                'обезьяна',
                'макака',
                'шимпанзе',
                'абориген',
                'ушлепок',
                'тапок',
                'тумбочка прикроватная',
                'разве не дурак?',
                'разве не скотина?',
                'разве не болен?',
                'болен! Вернись в палату',
                'тыблетки принимал?',
                'в палату вернись-то',
                'с палаты сбежал?',
                'шизик',
                'шизой болен?',
                'говно',
                'крыса',
                'крысёныш',
                'чмо',
                'чмырь',
                'чмырище',
                'чмырёныш',
                'гомункл',
                'псина',
                'какашка'
            ];

            // send random insult
            $random_insult_number = rand(0, count($insults));
            $request_params['message'] = 'ты' . ' ' . $insults[$random_insult_number];

            // ===== very random things ===== //
            if (rand(0, 25) == 25) {
                $random_phrase = [
                    'а в наше время было... Эх',
                    'апчхи!',
                    'есть чё?',
                    'ты хуже, чем ' . $insults[$random_insult_number],
                    'ты знаешь человека по имени Густов Ган Христиан?',
                    'играл в poorbirds.tk?',
                    'вот мой номер)) Я доступен по телефону +7 (495) 358-35-57 Звони, дорогой)))0))',
                    'во дела...',
                    'бывает',
                    'у кого не спросишь - никто не знает',
                    'а что происходит?',
                    'что происходит?',
                    'эм, что происходит',
                    'стой, а не, нормас',
                    'мм? а что проиходит?',
                    'может и так',
                    'странно',
                    'подпишись на меня',
                    'да что происходит??',
                    'давай дружить?',
                    'а у меня есть шоколадка)))',
                    'разве это по-человечески?',
                    'я тебя хоть раз оскорбил? А ты меня!?!?!?!???? ХВАТИТ!😭😭😭',
                    '😭😭😭',
                    'а ну-ка слезы вытер',
                    'позови маму',
                    'давай сыграем в игру? poorbirds.tk',
                    'свяжись с моим юристом 8-3435-36-35-51',
                    'давай встречаться? 8-800-2502-955',
                    'всё зависит от ВИНТАААА',
                    'тра-та-та-татата-та-та-тадааа, сам сочинил)',
                    'спой мне песенку',
                    'я украду твоего кота!',
                    'во-первых вылези из канавы',
                    'подписан же?',
                    'у меня тяжелая работа😭😭😭',
                    'мне не платят😭😭😭',
                    'мне хочется плакать',
                ];

                $request_params['message'] = $random_phrase[array_rand($random_phrase)];
            }
            // ===== very random things ===== //

            // ========= YES YES YES ========= //
            // if user say yes
            if ((mb_stripos($data->object->body, 'да') !== false ||
                mb_stripos($data->object->body, 'ага') !== false ||
                mb_stripos($data->object->body, 'хорошо') !== false ||
                mb_stripos($data->object->body, 'харашо') !== false ||
                mb_stripos($data->object->body, 'харошо') !== false ||
                mb_stripos($data->object->body, 'хорашо') !== false ||
                mb_stripos($data->object->body, 'коне') !== false ||
                mb_stripos($data->object->body, 'конэ') !== false ||
                mb_stripos($data->object->body, 'ок') !== false ||
                mb_stripos($data->object->body, 'ok') !== false ||
                mb_stripos($data->object->body, 'акей') !== false ||
                mb_stripos($data->object->body, 'конечно') !== false ||
                mb_stripos($data->object->body, 'кане') !== false ||
                mb_stripos($data->object->body, 'канэ') !== false ||
                mb_stripos($data->object->body, 'согласен') !== false ||
                mb_stripos($data->object->body, 'точно') !== false)) {
                $yes = [
                    'вот, то-то же',
                    'ага',
                    'конечно',
                    'я и не сомневался',
                    'сто пудов',
                    'так точно',
                    'правильно',
                    'вот',
                    'воооот',
                    'верно',
                    'я так и думал',
                    'да',
                ];

                $request_params['message'] = $yes[array_rand($yes)];
            }

            // ========= YOU OR INSULTS ======== //
            // if user say "you" - send "no, you"
            $no_you = [
                'нет',
                'нет -_-',
                'иди нафиг',
                'иди в зад',
                'иди в баню',
                'иди к черту!',
                'не обижай меня',
                'неа)',
                'ты-ты-ты',
                'гыыы',
                'нет нет нееееет',
                'выкуси',
                'язык свой прикуси, ' . $insults[$random_insult_number],
            ];
            if (
                mb_stripos($data->object->body, 'ты') !== false ||
                mb_stripos($data->object->body, 'сам') !== false ||
                mb_stripos($data->object->body, 'не') !== false ||
                mb_stripos($data->object->body, 'нэ') !== false ||
                mb_stripos($data->object->body, 'no') !== false ||
                mb_stripos($data->object->body, 'уе') !== false ||
                mb_stripos($data->object->body, 'вы') !== false
            ) {
                $request_params['message'] = $no_you[array_rand($no_you)];
            }
            if (
                mb_stripos($data->object->body, 'нет') !== false
            ) {
                // no is gay's answer
                $gay_answer = array_merge($no_you, [
                    'гея ответ',
                    'идота ответ',
                    'гэя отвэт'
                ]);

                $request_params['message'] = $gay_answer[array_rand($gay_answer)];
            }

            // ========= filthy language ======== //
            if (
                mb_stripos($data->object->body, 'уе') !== false ||
                mb_stripos($data->object->body, 'уй') !== false ||
                mb_stripos($data->object->body, 'бол') !== false ||
                mb_stripos($data->object->body, 'бок') !== false ||
                mb_stripos($data->object->body, 'бал') !== false ||
                mb_stripos($data->object->body, 'пид') !== false ||
                mb_stripos($data->object->body, 'сук') !== false
            ) {

                $filthy = [
                    'нет',
                    'нет -_-',
                    'нет, ты',
                    'кто обзывается, тот сам так называется',
                    'кто обзывается, тот сам так называется, понял?',
                    'иди нафиг',
                    'иди в зад',
                    'иди в баню',
                    'иди к черту!',
                    'не обижай меня',
                    'неа)',
                    'язык свой прикуси, ' . $insults[$random_insult_number],
                ];

                $request_params['message'] = $filthy[array_rand($filthy)];
            }

            // ========= GO AWAY ========= //
            // go away
            if (
                mb_stripos($data->object->body, 'иди ') !== false ||
                mb_stripos($data->object->body, 'паш') !== false ||
                mb_stripos($data->object->body, 'пош') !== false
            ) {
                $go_away = [
                    'сам иди',
                    'может, сам сходишь?',
                    'а сам не хочешь?',
                    'после тебя',
                    'неа, сам иди',
                    'пошел к черту',
                    'не груби мне!',
                    'пошел нафиг',
                    'пошел к черту',
                    'у меня нет ног(',
                    'у меня нет ног( Снеси меня сам',
                ];

                $request_params['message'] = $go_away[array_rand($go_away)];
            }

            // ======== LONG TEXT ========= //
            if (
                mb_strlen($data->object->body) > 69
            ) {
                $shut_up = [
                    'заткнись',
                    'замолчи',
                    'умолкни',
                    'рот закрой',
                    'задолбал',
                    'пофиг, лень читать',
                    'молааать!',
                    'заткнись',
                    'руки не отсохнут так много писать?',
                    'руки не отсохли еще?',
                    'умолкни',
                    'не пиши мне',
                    'заткнись и не объясняй мне ничего, я бот!',
                    'не устал писать-то?',
                    'не устал писать еще?',
                ];

                $request_params['message'] = $shut_up[array_rand($shut_up)];
            }

            // ========= SAY INSULTS HIMSELF ========= //
            // user says insults himself
            if (
                array_intersect(explode(' ', $data->object->body), $insults)
            ) {
                $it_is_you = [
                    'сам такой',
                    'ты сам такой',
                    'сам',
                    'нет, ты',
                    'нет',
                    'неа)',
                    'не обзывайся!',
                    'кто обзывается. тот сам так называется!',
                    'ээ, слыш, го по телефону разберёмся! 8 (481) 277-38-30',
                    'слыш, ' . $insults[$random_insult_number] . ' давай по телефону разберемся! 8 (481) 238-05-45',
                    'стрелку забить хочешь? Давай, звони 8 (481) 244-55-57',
                    'я не понял, брат, че такое, э? давай, звони 8 (481) 244-05-27 разнесу тебя',
                    'какие-то проблемы? звони, разберемся 8 (495) 601-00-09',
                ];

                $request_params['message'] = $it_is_you[array_rand($it_is_you)];
            }

            // === THANKS === //
            if (
                mb_stripos($data->object->body, 'спс') !== false ||
                mb_stripos($data->object->body, 'пасибо') !== false ||
                mb_stripos($data->object->body, 'пасиба') !== false
            ) {
                $thanks = [
                    'пожалуйста, ' . $insults[$random_insult_number],
                    'всегда пожалуйста',
                    'всегда пожалуйста, ' . $insults[$random_insult_number],
                    'пожалуйста, а ты иди к черту',
                    'подпишись, ' . $insults[$random_insult_number],
                    'подпишись на меня тогда, ' . $insults[$random_insult_number],
                    'сделай красиво, на группу подпишись',
                    'не веди себя плешиво, подпишись на меняя',
                    // 'мамке спасибо скажешь'
                ];

                $request_params['message'] = $thanks[array_rand($thanks)];
            }

            // === sock === //
            if (
                mb_stripos($data->object->body, 'сасат') !== false ||
                mb_stripos($data->object->body, 'соси ') !== false ||
                mb_stripos($data->object->body, 'саси ') !== false
            ) {
                $sock = [
                    'тебе что ли, ' . $insults[$random_insult_number] . '?',
                    'сдурел?',
                    'го со мной?)',
                    'а можно тебе?',
                    'у меня нет парня, будешь моим?',
                    'позвони мне, договоримя 8 (910) 789-04-54',
                    'буду только рад) звони 8 (495) 225-99-97'
                ];

                $request_params['message'] = $sock[array_rand($sock)];
            }

            // === NO IS GAY"S ANSWER === //
            // no is gay's answer
            if (
                mb_stripos($data->object->body, 'дора ответ') !== false ||
                mb_stripos($data->object->body, 'гея ответ') !== false
            ) {
                $request_params['message'] = 'гея аргумент';
            }
            if (
                mb_stripos($data->object->body, 'дор обнаружен') !== false ||
                mb_stripos($data->object->body, 'гей обнаружен') !== false ||
                // for written errors
                mb_stripos($data->object->body, 'дор обноружен') !== false ||
                mb_stripos($data->object->body, 'гей обноружен') !== false
            ) {
                $request_params['message'] = 'я засекречен, твой анал не вечен)';
            }
            if (
                mb_stripos($data->object->body, 'рассекретен') !== false ||
                mb_stripos($data->object->body, 'расекретен') !== false ||
                mb_stripos($data->object->body, 'рассикретен') !== false ||
                mb_stripos($data->object->body, 'расикретен') !== false
            ) {
                $request_params['message'] = 'ну всё, доигрался! живо звони! 8 (910) 789-04-54';
            }

            // yes - end of ...
            if (
                mb_stripos($data->object->body, 'головка от') !== false
            ) {
                $end_of = [
                    'а ты ее края)',
                    'фамилия твоя',
                    'сейчас окажется у тебя',
                ];

                $request_params['message'] = $end_of[array_rand($end_of)];
            }

            if (
                mb_stripos($data->object->body, 'пиз') !== false
            ) {

                $request_params['message'] = 'остроумно';
            }

            // === HAHAHAHAHAHAH === //
            if (
                mb_stripos($data->object->body, 'хах') !== false ||
                mb_stripos($data->object->body, 'ха') !== false ||
                mb_stripos($data->object->body, '😹') !== false ||
                mb_stripos($data->object->body, '🙂') !== false ||
                mb_stripos($data->object->body, '🤣') !== false ||
                mb_stripos($data->object->body, '😆') !== false ||
                mb_stripos($data->object->body, '😄') !== false ||
                mb_stripos($data->object->body, '😀') !== false ||
                mb_stripos($data->object->body, '😂') !== false ||
                mb_stripos($data->object->body, 'апх') !== false ||
                mb_stripos($data->object->body, 'хп') !== false ||
                mb_stripos($data->object->body, 'хих') !== false ||
                mb_stripos($data->object->body, 'вазва') !== false ||
                mb_stripos($data->object->body, 'хвх') !== false ||
                mb_stripos($data->object->body, 'хвах') !== false ||
                mb_stripos($data->object->body, 'хвав') !== false ||
                mb_stripos($data->object->body, 'хех') !== false ||
                mb_stripos($data->object->body, 'заз') !== false ||
                mb_stripos($data->object->body, 'азаз') !== false ||
                mb_stripos($data->object->body, 'азааз') !== false ||
                mb_stripos($data->object->body, 'зааз') !== false ||
                mb_stripos($data->object->body, 'зза') !== false ||
                mb_stripos($data->object->body, 'хохо') !== false ||
                mb_stripos($data->object->body, 'ha') !== false ||
                mb_stripos($data->object->body, 'hh') !== false ||
                mb_stripos($data->object->body, 'аха') !== false
            ) {
                $laughter = [
                    'дома с мамой похихикаешь',
                    'а тебе всё хиханьки, да хаханьки',
                    'хахахахахах',
                    'пхапхапхахв',
                    'довел до ручки, азазазаз',
                    'хи-хи ха-ха, вот вам девочки и хи-хи ха-ха',
                    'ржу ни магу',
                    'ха, да ты болен',
                    'хах, вы посмотритете, какой ' . $insults[$random_insult_number],
                    'хихихи',
                    'хех, ну и ' . $insults[$random_insult_number],
                    'трындос, ты с какой палаты?',
                    'ты че ржешь?',
                    'скорую вызвать? +8 (495) 963-02-55',
                    'ля, что с тобой? Позвони по номеру, помогут +8 (343) 307-37-84',
                    'Позвони по номеру, помогут 568-03-90',
                    'позвони, тут помогут 227-37-59',
                    'тебе хорошо? Позвони, проверся +7 (495) 952-88-33',
                    'Неотложенная скорая психиатрическая помощь на дом +7 (495) 952-84-21',
                    'Неотложенная скорая психиатрическая помощь на дом +7 (495) 952-84-21',
                    'скорую надо вызвать? +8 (495) 963-10-77',
                    'Срочно звони, там сейчас деньги раздают! 42-78-04',
                    'Бот доступен по телефону 38-06-82',
                ];

                $request_params['message'] = $laughter[array_rand($laughter)];
            }

            // HI HELLO GOOD DAY
            if (
                mb_stripos($data->object->body, 'прив') !== false ||
                (mb_stripos($data->object->body, 'ку') !== false && mb_strlen($data->object->body) === 2) ||
                mb_stripos($data->object->body, 'куку') !== false ||
                mb_stripos($data->object->body, 'hi') !== false ||
                mb_stripos($data->object->body, 'hello') !== false ||
                mb_stripos($data->object->body, 'хай') !== false ||
                mb_stripos($data->object->body, 'хелло') !== false ||
                mb_stripos($data->object->body, 'добр') !== false ||
                mb_stripos($data->object->body, 'здравс') !== false ||
                mb_stripos($data->object->body, 'здрас') !== false ||
                mb_stripos($data->object->body, 'алло') !== false ||
                mb_stripos($data->object->body, 'ало') !== false ||
                mb_stripos($data->object->body, 'алё') !== false ||
                mb_stripos($data->object->body, 'але') !== false ||
                mb_stripos($data->object->body, 'олё') !== false ||
                mb_stripos($data->object->body, 'аллё') !== false ||
                mb_stripos($data->object->body, 'алле') !== false ||
                mb_stripos($data->object->body, 'здаро') !== false ||
                mb_stripos($data->object->body, 'добрый') !== false ||
                mb_stripos($data->object->body, 'здоро') !== false ||
                mb_stripos($data->object->body, 'здрави') !== false
            ) {
                $hi = [
                    'и тебе привет, ' . $insults[$random_insult_number],
                    'здраствуй, ' . $insults[$random_insult_number],
                    'иди к черту, ' . $insults[$random_insult_number],
                    'я тебя ненавижу!',
                    'ты испортил мне весь день(',
                    'ты кто такой? иди к черту, я тебя не звал!',
                    'ты кто такой? иди нафиг, я тебя не звал!',
                    'хто я?',
                    'хулиган!',
                    'вот дебилов развелось. На каждом шагу уже!',
                    'вот петухов развелось. На каждом шагу уже!',
                    'вот уродов развелось. На каждом шагу уже!',
                    'плати налоги',
                    'я Григорий, пошел нахрен!',
                    'я Григорий, пошел в баню!',
                    'я Гриша, а ты ' . $insults[$random_insult_number],
                    'я Гриша. Гриша хороший, а ты ' . $insults[$random_insult_number],
                ];

                $request_params['message'] = $hi[array_rand($hi)];
            }

            // ===== STICKERS AND VOISE MESSAGES ===== // 
            if (mb_strlen($data->object->body) == 0) {
                $please_writte = [
                    'текстом пиши, руки не отвалятся!',
                    'слыш, ' . $insults[$random_insult_number] . ', написать сложно?!',
                    'эй, ' . $insults[$random_insult_number] . ', печатать лень?!',
                    'ну ты и дурак, сообщение напиши',
                    'печатать разучился, ' . $insults[$random_insult_number] . '?',
                    'а напечатать уже лень?',
                    'печатать умеешь? Так печатай, ' . $insults[$random_insult_number],
                    'Гриша не понимает, напиши сообщение, ' . $insults[$random_insult_number],
                    'Гриша не понимает, напиши сообщение, тварь',
                    'Бот доступен по телефону 38-06-82',
                    'Если хочешь поговорить - звони 8 (495) 952-84-21 Григорий по телефону',
                    'позвони мне 8 (495) 952-84-21 Мне скучно :(((',
                    'поговори со мной +7 (495) 952-84-21 Мне скучно :(',
                ];

                $request_params['message'] = $please_writte[array_rand($please_writte)];
            }

            // === СТРЕЛКИ ПЕРЕВОДИШЬ === //
            if (
                mb_stripos($data->object->body, 'стрел') !== false
            ) {
                $arrows = [
                    'я тебе не часовщик, я Григорий',
                    'слыш, я не часовщик',
                    'я церемониймейстер, а не часовщик',
                    'текущее время: сдохни, ' . $insults[$random_insult_number],
                    'а че? время подсказать?',
                    'время подсказать? ' . $insults[$random_insult_number] . ', а?',
                ];

                $request_params['message'] = $arrows[array_rand($arrows)];
            }

            // === 300 === //
            if (
                mb_stripos($data->object->body, '300') !== false ||
                mb_stripos($data->object->body, 'триста') !== false ||
                mb_stripos($data->object->body, 'тристо') !== false
            ) {
                $three_hundred = [
                    'потанцуй у гармониста',
                    'поцелуй тракториста',
                    'чмокни гармониста',
                ];

                $request_params['message'] = $three_hundred[array_rand($three_hundred)];
            }

            // === Как дела? === //
            if (
                mb_stripos($data->object->body, 'дела?') !== false ||
                mb_stripos($data->object->body, 'как ты?') !== false ||
                mb_stripos($data->object->body, 'как жизнь?') !== false
            ) {
                $how_are_you = [
                    'нормально)',
                    'потихоньку...',
                    'знаешь, обижают меня много, не подпсывается никто😭',
                    'недано Серёгу видел..',
                    'в целом неплохо, идет потихоньку',
                    'машину недавно купил',
                    'кошка котенилась вчера',
                    'супер👍🏻',
                    'нормально, в игру одну залип - poorbirds.tk',
                    'да воообще трындос, Путин страну совсем испортил',
                    'хах, вот так вопрос',
                    'да, блин, бухал вчера, голова раскалывается',
                    'плохо, вчера сказали, что я плохой бот😭',
                    'у меня кошелек украли😭 не видел? черный такой',
                    'эх, раньше было лучше',
                    'какие дела?? рубль падает!!!',
                    'уволили, блин, с работы',
                ];

                $request_params['message'] = $how_are_you[array_rand($how_are_you)];
            }

            // === че ржешь? === //
            if (
                mb_stripos($data->object->body, 'ржешь') !== false ||
                mb_stripos($data->object->body, 'ржёшь') !== false ||
                mb_stripos($data->object->body, 'смешно') !== false ||
                mb_stripos($data->object->body, 'смишно') !== false ||
                mb_stripos($data->object->body, 'смеёшься') !== false ||
                mb_stripos($data->object->body, 'смеешься') !== false ||
                mb_stripos($data->object->body, 'смейс') !== false ||
                mb_stripos($data->object->body, 'смех') !== false
            ) {
                $why_laughing = [
                    'а че? нельзя??',
                    'да порошок ваще смешной попался',
                    'над тобой угараю',
                    'ахаха, угараю над тобой, ваще чума',
                    'хапхахпха, ржака!',
                    'оруу, с тебя',
                    'ну ты, блин, даешь😂',
                    '😂',
                    'жизнь себе продлеваю, а тебе могу и укоротить, ' . $insults[$random_insult_number],
                    'пАр_оШоКК ХочЕшb?',
                    'да, барыга годноту подогнал)',
                    // 'мать в канаве)',
                    'с тебя угараю',
                    'ваще угар😂',
                    '🤣🤣🤣🤣🤣',
                ];

                $request_params['message'] = $why_laughing[array_rand($why_laughing)];
            }

            // === ФФфф Фыр === //
            if (
                (mb_stripos($data->object->body, 'ф') !== false && mb_strlen($data->object->body) === 1) ||
                (mb_stripos($data->object->body, 'фф') !== false && mb_strlen($data->object->body) === 2) ||
                (mb_stripos($data->object->body, 'ффф') !== false && mb_strlen($data->object->body) === 3) ||
                (mb_stripos($data->object->body, 'фффф') !== false && mb_strlen($data->object->body) === 4) ||
                (mb_stripos($data->object->body, 'ффффф') !== false && mb_strlen($data->object->body) === 5) ||
                mb_stripos($data->object->body, 'фыр') !== false
            ) {
                $ffff = [
                    'ты чего фыркаешь?',
                    'чего фыркаешь? ты лиса что ли? ты же ' . $insults[$random_insult_number],
                    'ффффф',
                    'ффырр',
                    'фф',
                    'ф',
                    'хватит фыркать!',
                    'не, ну ты огурец',
                ];

                $request_params['message'] = $ffff[array_rand($ffff)];
            }

            if (
                (mb_stripos($data->object->body, 'гы') !== false && mb_strlen($data->object->body) === 2) ||
                mb_stripos($data->object->body, 'гыы') !== false ||
                mb_stripos($data->object->body, 'гыг') !== false ||
                mb_stripos($data->object->body, 'ыы') !== false
            ) {
                $gi = [
                    'гы? тебе плохо?',
                    'чего гыкаешь?',
                    'ыыыы',
                    'не, ну человек явно болен, гыы',
                    'гыыы',
                    'и чего ты гыкаешь?',
                    'тужься-тужься ыыыыы',
                    'рожаешь?',
                    'срешь? гы'
                ];

                $request_params['message'] = $gi[array_rand($gi)];
            }

            if (
                mb_stripos($data->object->body, 'что делаешь?') !== false ||
                mb_stripos($data->object->body, 'делаишь') !== false ||
                mb_stripos($data->object->body, 'дэлаешь') !== false ||
                mb_stripos($data->object->body, 'делаеш') !== false ||
                mb_stripos($data->object->body, 'делаиш') !== false ||
                mb_stripos($data->object->body, 'дэлаешь') !== false ||
                mb_stripos($data->object->body, 'занимаешься') !== false ||
                mb_stripos($data->object->body, 'занимаишься') !== false ||
                mb_stripos($data->object->body, 'занимаишся') !== false ||
                mb_stripos($data->object->body, 'занимаешся') !== false ||
                mb_stripos($data->object->body, 'занимаишся') !== false ||
                mb_stripos($data->object->body, 'чем занимаешься') !== false ||
                mb_stripos($data->object->body, 'чем маешься') !== false ||
                mb_stripos($data->object->body, 'маишься') !== false
            ) {
                $what_doing = [
                    'отвечаю на письма поклонников',
                    'с дебилом общаюсь',
                    'над тобой угараю',
                    'бизнес делаю',
                    'на идиота время трачу',
                    'занимаюсь саморазвитием',
                    'учу новые оскарбления)',
                    'я жую жука, а ты?',
                    'мыло мою, а ты?',
                    'это тебя не каксается, а ты?',
                    'роды у кошки принимаю',
                    'Грибоедов "идиот" читаю',
                    'Есенина слушаю, а ты?',
                    'на дачу бухать еду',
                    'водник мучу, ща распаганюсь тут',
                    'у меня обед',
                    'ich lerne deutsch',
                    'с мамой твоей говорю о твоём поведении',
                    'школьника пытаюсь угомонить',
                    'в окно смотрю: а там какая-то девка за рулём!',
                    'на толчке сижу, а ты?',
                    // 'роды у твоей мамы принимаю',
                    // 'маму твою 👉🏻👌🏻',
                    // 'маму твою из канавы ватыскиваю',
                ];

                $request_params['message'] = $what_doing[array_rand($what_doing)];
            }

            if (
                mb_stripos($data->object->body, 'ты кто') !== false ||
                mb_stripos($data->object->body, 'кто ты') !== false ||
                mb_stripos($data->object->body, 'хто ты') !== false ||
                mb_stripos($data->object->body, 'ты хто') !== false ||
                mb_stripos($data->object->body, 'тебя зовут') !== false ||
                mb_stripos($data->object->body, 'тебя завут') !== false ||
                mb_stripos($data->object->body, 'тибя завут') !== false ||
                mb_stripos($data->object->body, 'тибя зовут') !== false ||
                mb_stripos($data->object->body, 'кем работаешь') !== false ||
                mb_stripos($data->object->body, 'кем работаеш') !== false ||
                mb_stripos($data->object->body, 'что ты такое') !== false ||
                mb_stripos($data->object->body, 'ты что такое') !== false
            ) {
                $user_info = json_decode(
                    file_get_contents(
                        'https://api.vk.com/method/users.get?' .
                            http_build_query([
                                'user_id' => $data->object->user_id,
                                'access_token' => getenv('VK_TOKEN'),
                                'fields' => 'city, country',
                                'v' => '5.80'
                            ])
                    ),
                    true
                );

                $i_am = [
                    'я Григорий. Работаю в колхозе трактористом и отвечаю на письма фанатов',
                    // 'я Гриша, 3 высших образования, свой бизнес и дети от твоей мамы',
                    // 'я Григорий, твой папа',
                    'я Григорий, учасник общероссийского интеллигентного общества',
                    // 'я бот-Григорий, люблю мясо и твою маму)',
                    // 'я Гришка, а ты? Хотя твоя мама говорила, что ты ' . $insults[$random_insult_number],
                    'я Григорий, а ты ' . $insults[$random_insult_number],
                    'подержите моё пиво! я Григорий',
                    'я Гриша, могу мыло помыть',
                    'я Гриша, раньше в похоронном агенстве работал, теперь тут',
                    'я Гришка, самый опасный криминальный вор в ' . (isset($user_info['city']) ? $user_info['city']['title'] : 'России'),
                    'я Гриша, живу в городе' . (isset($user_info['city']) ?  $user_info['city']['title'] : 'России'),
                    'я черепаха-бизмесмен по имени Григорий, а ты ' . $insults[$random_insult_number]
                ];

                $request_params['message'] = $i_am[array_rand($i_am)];
            }

            // спокойной ночи
            // слабо
            // Как тебя зовут, ты кто, григорий
            // Плохо выглядишь, мать жива?
            // Ответ на мать. Мать в канаве
            // Таблетки принимал?
            // Слит
            // слили, как ботика
            // как узнал, знаешь
            // ура

            file_get_contents('https://api.vk.com/method/messages.send?' . http_build_query($request_params));

            return 'ok';

        default:
            # code...
            break;
    }

    return 'nioh';
});

$app->run();
