<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of lhAbstractRuNames
 *
 * @author user
 */
require_once __DIR__ . '/../interface/lhRuNamesInterface.php';

abstract class lhAbstractRuNames implements lhRuNamesInterface {
    
    protected $name;
    protected $names;
    protected $gender;
    protected $known_name;


    public function __construct($name=null) {
        $this->setName($name);
    }
    
    public function gender() {
        return $this->gender;
    }

    public function is_known() {
        return $this->known_name;
    }

    protected function setName($name=null) {
        if (($this->name != $name) && ($name !== null)) {
            $this->name = preg_replace_callback("/^(.)(.*)$/u", function ($matches) {
                return mb_strtoupper($matches[1], "UTF-8") . mb_strtolower($matches[2], "UTF-8");
            }, $name);
            $this->setNames();
        }
        return $this->name;
    }

    abstract protected function setNames(); // должна устновить массис массивов $this->names, $this->gender и $this->known_name

    public static $gender_female = 0;
    public static $gender_male = 1;
    protected static $mens_names = '
        Абрам
        Аваз
        Аввакум
        Август
        Авдей
        Авраам
        Автандил
        Агап
        Агафон
        Аггей
        Адам
        Адис
        Адольф
        Адриан
        Азамат
        Азарий
        Азат
        Айдар
        Айнур
        Айрат
        Акакий
        Аким
        Алан
        Александр Саша !Саш _!Сашунь #Саня #!Сань #Санёк #Санек #Санчо
        Алексей
        Али
        Алихан
        Алмаз
        Альберт
        Альфред
        Амадей
        Амадеус
        Амаяк
        Амин
        Амвросий
        Анатолий
        Анвар
        Ангел
        Андрей _Андрюша _!Андрюш #Андрюха #!Aндрюх
        Андрэ
        Аникита
        Антон
        Ануфрий
        Анфим
        Аполлинарий
        Арам
        Аристарх
        Аркадий
        Арман
        Армен
        Арно
        Арнольд
        Арон
        Арсен
        Арсений
        Арслан
        Артем
        Артемий
        Артур
        Архип
        Аскольд
        Афанасий
        Ахмет
        Ашот
        Бахрам
        Бежен
        Бенедикт
        Берек
        Бернар
        Богдан
        Боголюб
        Бонифаций
        Бореслав
        Борис
        Борислав
        Боян
        Бронислав
        Бруно
        Булат
        Вадим
        Валентин
        Валерий
        Вальдемар
        Вальтер
        Вардан
        Варлаам
        Варфоломей
        Василий Вася !Вась
        Ватслав
        Велизар
        Велор
        Венедикт
        Вениамин
        Викентий
        Виктор
        Вилен
        Вилли
        Вильгельм
        Виссарион
        Виталий Виталик
        Витаутас
        Витольд
        Владимир
        Владислав Влад
        Владлен
        Влас
        Володар
        Всеволод
        Вячеслав Слава !Слав
        Гавриил
        Галактион
        Гамлет
        Гарри
        Гаяс
        Гевор
        Геворг
        Геннадий
        Генри
        Генрих
        Георгий
        Геральд
        Герасим
        Герман
        Глеб
        Гоар
        Гордей
        Гордон
        Горислав
        Градимир
        Григорий
        Гурий
        Густав
        Давид
        Давлат
        Дамир
        Даниил
        Данислав
        Даньяр
        Демид
        Демьян
        Денис
        Джамал
        Джеймс
        Джереми
        Джозеф
        Джордан
        Джорж
        Дик
        Динар
        Динасий
        Дмитрий
        Добрыня
        Дональд
        Донат
        Донатос
        Дорофей
        Евгений
        Евграф
        Евдоким
        Евсей
        Евстафий
        Егор
        Елизар
        Елисей
        Емельян
        Еремей
        Ермолай
        Ерофей
        Ефим
        Ефрем
        Жан
        Ждан
        Жерар
        Закир
        Замир
        Заур
        Захар
        Зенон
        Зигмунд
        Зиновий
        Зураб
        Ибрагим
        Иван
        Игнат
        Игнатий
        Игорь
        Иероним
        Измаил
        Израиль
        Илиан
        Илларион
        Ильхам
        Ильшат
        Илья
        Ильяс
        Инокентий
        Иоанн
        Иоаким
        Ион
        Иосиф
        Ипполит
        Ираклий
        Иса
        Исаак
        Исидор
        Искандер
        Ислам
        Исмаил
        Казбек
        Казимир
        Камиль
        Карен
        Карим
        Карл
        Ким
        Кир
        Кирилл
        Клавдий
        Клаус
        Клим
        Климент
        Клод
        Кондрат
        Константин
        Корней
        Корнилий
        Кузьма
        Лавр
        Лаврентий
        Лазарь
        Лев
        Леван
        Левон
        Ленар
        Леон
        Леонард
        Леонид
        Леонтий
        Леопольд
        Лука
        Лукьян
        Любим
        Любомир
        Людвиг
        Люсьен
        Люций
        Мавлюда
        Мадлен
        Май
        Майкл
        Макар
        Макарий
        Максим
        Максимильян
        Максуд
        Мансур
        Мануил
        Мар
        Марат
        Мариан
        Марк
        Марсель
        Мартин
        Матвей
        Махмуд
        Мераб
        Мефодий
        Мечеслав
        Микула
        Милан
        Мирон
        Мирослав
        Митрофан
        Михаил
        Мишлов
        Модест
        Моисей
        Мстислав
        Мурат
        Муслим
        Мухаммед
        Назар
        Назарий
        Наиль
        Натан
        Наум
        Нестор
        Никанор
        Никита
        Никифор
        Никодим
        Никола
        Николай
        Никон
        Нильс
        Нисон
        Нифонт
        Норманн
        Овидий
        Олан
        Олег
        Олесь
        Онисим
        Орест
        Орландо
        Осип _Ося _!Ось
        Оскар
        Остап
        Павел Паша #Павлуха #!Павлух _Пашуня _!Пашунь
        Панкрат
        Парамон _Парамоша _!Парамош
        Петр Петя _Петюша _Петечка _Петенька !Петь _!Петюш #Петро #Петрович Пётр
        Платон
        Порфирий
        Потап
        Прокофий
        Прохор
        Равиль
        Радий
        Радик
        Радомир
        Радослав
        Разиль
        Райан
        Раймонд
        Раис
        Рамазан
        Рамиз
        Рамиль
        Рамон
        Ранель
        Расим
        Расул
        Ратибор
        Ратмир
        Рафаил
        Рафаэль
        Рафик
        Рашид
        Рем
        Ринат
        Рифат
        Рихард
        Ричард
        Роберт
        Родион
        Ролан
        Роман
        Ростислав Слава !Слав
        Рубен
        Рудольф
        Руслан
        Рустам
        Руфин
        Рушан
        Рэй
        Сабир
        Савва
        Савелий
        Самвел
        Самсон
        Самуил
        Святослав
        Севастьян
        Северин
        Семен
        Серафим
        Сергей
        Сидор
        Сократ
        Соломон
        Спартак
        Стакрат
        Станислав
        Степан
        Стефан
        Стивен
        Стоян
        Султан
        Тагир
        Таис
        Тайлер
        Талик
        Тамаз
        Тамерлан
        Тарас
        Тельман
        Теодор
        Терентий
        Тибор
        Тиграм
        Тигран
        Тигрий
        Тимофей
        Тимур
        Тит
        Тихон
        Томас
        Трифон
        Трофим
        Ульманас
        Умар
        Устин
        Фадей
        Фазиль
        Фанис
        Фарид
        Фархад
        Федор
        Федот
        Феликс
        Феодосий
        Фердинанд
        Фидель
        Филимон
        Филипп
        Флорентий
        Фома
        Франц
        Фред
        Фридрих
        Фуад
        Хабиб
        Хаким
        Харитон
        Христиан
        Христос
        Христофор
        Цезарь
        Чарльз
        Чеслав
        Чингиз
        Шамиль
        Шарль
        Шерлок
        Эдвард
        Эдгар
        Эдмунд
        Эдуард
        Эльдар
        Эмиль
        Эмин
        Эммануил
        Эраст
        Эрик
        Эрнест
        Юлиан
        Юлий
        Юнус
        Юрий
        Юхим
        Яков
        Ян
        Януарий
        Ярослав Слава !Слав
        Ясон               
    ';

    protected static $womens_names = '
        Августа
        Авдотья
        Аврора
        Агата
        Агапия
        Агафья
        Аглая
        Агнесса
        Агния
        Агриппина
        Агунда
        Ада
        Аделина
        Аделаида
        Адель
        Адиля
        Адриана
        Аза
        Азалия
        Азиза
        Айгуль
        Айлин
        Айнагуль
        Аида
        Айжан
        Аксинья
        Акулина
        Алана
        Алевтина
        Александра Саша _Сашуня !Саш _!Сашунь
        Алена
        Алико
        Алина
        Алиса
        Алия
        Алла
        Алсу
        Альба
        Альберта
        Альбина
        Альвина
        Альфия
        Альфреда
        Аля
        Амаль
        Амелия
        Амина
        Амира
        Анаит
        Анастасия
        Ангелина
        Анеля
        Анжела
        Анжелика
        Анисья
        Анита
        Анна
        Антонина
        Анфиса
        Аполлинария
        Арабелла
        Ариадна
        Ариана
        Арина
        Архелия
        Асель
        Асия
        Ассоль
        Астра
        Астрид
        Ася
        Аурелия
        Афанасия
        Аэлита
        Беатриса
        Белинда
        Белла
        Берта
        Бирута
        Богдана
        Божена
        Борислава
        Бронислава
        Валентина
        Валерия
        Ванда
        Ванесса
        Варвара Варя !Варь !Вареник
        Василина
        Василиса Вася !Вась
        Венера
        Вера
        Вероника Ника !Ник
        Веселина
        Весна
        Веста
        Вета
        Вида
        Викторина
        Виктория
        Вилена
        Вилора
        Виолетта
        Виргиния
        Виринея
        Вита
        Виталина
        Влада
        Владислава
        Владлена
        Габриэлла
        Галина
        Галия
        Гаянэ
        Гелена
        Гаянэ
        Гелена
        Гелла
        Генриетта
        Георгина
        Гера
        Гертруда
        Глафира
        Глория
        Гортензия
        Гражина
        Грета
        Гузель
        Гулия
        Гульмира
        Гульназ
        Гульнара
        Гульшат
        Дайна
        Далия
        Дамира
        Дана
        Даниэла
        Данута
        Дара
        Дарина
        Дарья Даша !Даш _Дашуня _Дашенька _!Дашунь
        Даяна
        Дебора
        Джамиля
        Джемма
        Дженнифер
        Джессика
        Джулия
        Джульетта
        Диана
        Дилара
        Дильназ
        Дильнара
        Диля
        Дина
        Динара
        Диодора
        Дионисия
        Долорес
        Доля
        Доминика
        Дора
        Ева
        Евангелина
        Евгения Женя _Жека _!Жек _Женечка _!Женечка !Жень
        Евдокия
        Екатерина Катя _Катюша _!Катюш _!Катю !Кать _Катенька _!Катенька
        Елена
        Елизавета
        Есения
        Ефимия
        Жанна
        Жасмин
        Жозефина
        Забава
        Заира
        Замира
        Зара
        Зарема
        Зарина
        Захария
        Земфира
        Зинаида
        Зита
        Злата
        Зоряна
        Зоя
        Зульфия
        Зухра
        Иванна
        Иветта
        Ивона
        Ида
        Изабелла
        Изольда
        Илария
        Илиана
        Илона
        Инара
        Инга
        Ингеборга
        Индира
        Инесса
        Инна
        Иоанна
        Иоланта
        Ираида
        Ирина
        Ирма
        Искра
        Ия
        Калерия
        Камилла
        Капитолина
        Карима
        Карина
        Каролина
        Катарина
        Катия
        Кира
        Клавдия
        Клара
        Кларисса
        Климентина
        Констанция
        Кора
        Корнелия
        Кристина
        Ксения !Ксень _!Ксюш #Ксюха #!Ксюх
        Лада
        Лайма
        Лана
        Лара
        Лариса
        Лаура
        Лейла
        Лейсан
        Леокадия
        Леонида
        Лера
        Леся
        Лиана
        Лидия
        Лиза
        Лика
        Лилиана
        Лилия
        Лина
        Линда
        Лиора
        Лира
        Лия
        Лола
        Лолита
        Лора
        Луиза
        Лукерья
        Любовь
        Людмила
        Ляля
        Люция
        Магда
        Магдалина
        Мадина
        Майя
        Малика
        Мальвина
        Мара
        Маргарита Рита Марго !Рит _Маргоша _Ритуля _Ритуся _Туся _!Тусь _!Маргош _!Ритусь _!Ритуль _!Туль _!Гош
        Марианна
        Марика
        Марина
        Мария Маша !Маш _Машенька _Машуня _!Машунь #Maxa #!Мах
        Марселина
        Марта
        Маруся
        Марфа _Марфуша _!Марфуш
        Марьям
        Матильда
        Мелания
        Мелисса
        Мика
        Мила
        Милада
        Милана
        Милена
        Милица
        Милолика
        Милослава
        Мира
        Мирослава
        Мирра
        Моника
        Муза
        Мэри
        Надежда
        Назира
        Наиля
        Наима
        Нана
        Наоми
        Наталья
        Нателла
        Нелли
        Неонила
        Ника
        Николь
        Нина
        Нинель
        Нонна
        Нора
        Нурия
        Одетта
        Оксана
        Октябрина
        Олеся
        Оливия
        Ольга
        Офелия
        Павла
        Павлина
        Памела
        Патриция
        Пелагея
        Перизат
        Полина
        Прасковья
        Рада
        Радмила
        Раиса
        Ревекка
        Регина
        Рема
        Рената
        Римма
        Рина
        Рита _!Ритуль _!Ритусь _!Тусь
        Рогнеда
        Роберта
        Роза
        Роксана
        Ростислава
        Рузалия
        Рузанна
        Рузиля
        Румия
        Русалина
        Руслана
        Руфина
        Сабина
        Сабрина
        Сажида
        Саида
        Саломея
        Самира
        Сандра
        Сания
        Санта
        Сара
        Сати
        Светлана
        Святослава
        Севара
        Северина
        Селена
        Серафима
        Сильва
        Сима
        Симона
        Слава
        Снежана
        Соня
        София
        Станислава
        Стелла
        Стефания
        Сусанна
        Таира
        Таисия
        Тала
        Тамара
        Тамила
        Тара
        Татьяна
        Тереза
        Тина
        Тора
        Ульяна
        Урсула
        Устина
        Устинья
        Фаиза
        Фаина
        Фания
        Фаня
        Фарида
        Фатима
        Фая
        Фекла
        Фелиция
        Феруза
        Физура
        Флора
        Франсуаза
        Фрида
        Харита
        Хилари
        Хильда
        Хлоя
        Христина
        Цветана
        Челси
        Чеслава
        Чулпан
        Шакира
        Шарлотта
        Шейла
        Шелли
        Шерил
        Эвелина
        Эвита
        Эдда
        Эдита
        Элеонора
        Элиана
        Элиза
        Элина
        Элла
        Эллада
        Элоиза
        Эльвина
        Эльвира
        Эльга
        Эльза
        Эльмира
        Эльнара
        Эля
        Эмилия
        Эмма
        Эмили
        Эрика
        Эрнестина
        Эсмеральда
        Этель
        Этери
        Юзефа
        Юлия
        Юна
        Юния
        Юнона
        Ядвига
        Яна
        Янина
        Ярина
        Ярослава
        Ясмина            
    ';
    
}
