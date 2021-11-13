  
create database jonatanblog;
use jonatanblog;

create table user_login(
        user_id int auto_increment not null,
        nickName varchar(50) not null,
        password varchar(500) not null,
        primary key(user_id)
);

ALTER TABLE user_login CONVERT TO CHARACTER SET utf8mb4;

create table article_category (
        category_id int auto_increment not null,
        category varchar(50) not null,
        primary key(category_id)
);

ALTER TABLE article_category CONVERT TO CHARACTER SET utf8mb4;

create table article (
        article_id int auto_increment not null,
        article_header varchar(255) not null,
        article_src varchar(1000),
        article_text LONGTEXT CHARACTER SET utf8,
        article_category_id int,
        article_created DATE not null,
        article_updated DATE not null,
        article_owner_id int,
        FOREIGN KEY(article_category_id) REFERENCES article_category (category_id),
        FOREIGN KEY(article_owner_id) REFERENCES user_login (user_id),
        primary key(article_id)
);

ALTER TABLE article CONVERT TO CHARACTER SET utf8mb4;

create table article_comment (
        comment_id int auto_increment not null,
        comment_for_article_id int not null,
        comment_owner_id int not null,
        comment varchar(255) not null,
        FOREIGN KEY(comment_for_article_id) references article(article_id),
        FOREIGN KEY(comment_owner_id) references user_login(user_id),
        primary key(comment_id)
);

ALTER TABLE article_comment CONVERT TO CHARACTER SET utf8mb4;

INSERT INTO article_category (category) values ("życiorys");
INSERT INTO article_category (category) values ("opinia");
INSERT INTO article_category (category) values ("kurs");
INSERT INTO article_category (category) values ("polecenia");
INSERT INTO article_category (category) values ("o wszystkim i o niczym");

INSERT INTO user_login (nickName, password ) values (
        'michalina',
        "$2a$12$uSknZ79hRVaobfJYobmPVO8LOUFLKl1Fk5e2HtcHdiLtc05OMZU1W"
); 
-- // pass - qwerty123

INSERT INTO user_login (nickName, password ) values (
        'esbeda',
        "$2a$12$5obW8X.QJo74JdnA.p/.qOE2T0LzwqN8uIK0a4VXj5JyQbiNFFyJa"
); 
-- // pass - bedido

INSERT INTO user_login (nickName, password ) values (
        'virtual',
        "$2a$12$DBRzhWQoGTdH4s4Lu7a8huw9gtFBlNJBt/t/DS4tKXFjSWlkp1oUa"
); 
-- // pass - wersena

INSERT INTO user_login (nickName, password ) values (
        'tibbera',
        "$2a$12$Qk.eHMIx2yNs7d0TGjtIpuZVsO1x2wIdoX7ONfm09GMzyc.ShH3um"
); 
-- // pass - ber$wersa

INSERT INTO user_login (nickName, password ) values (
        'assertan',
        "$2a$12$TgLef2VGqn9LC/ufS14dJOKI0ePbrOzctWkinExickZ.f0t6Tk6g2"
); 
-- // pass - n67we

INSERT INTO user_login (nickName, password ) values (
        'pynerson',
        "$2a$12$MMHa51kHdCr7vSrwwbKcsuuIIuQbUTBno3kNYBaoFjAnhZtERe61."
); 

-- // pass - tyr465ew


INSERT INTO article 
(
        article_header,
        article_src,
        article_text,
        article_category_id,
        article_created,
        article_updated,
        article_owner_id
) values (
        "Domowy sposób na owsianke",
        "https://kuchnia-marty.pl/wp-content/uploads/2016/02/5438.900.jpg",
        '{ "text_1" : "Owies i owsiane produkty są skarbnicą składników odżywczych. Owies to źródło białka bogatego w aminokwasy egzogenne. Organizm nie jest w stanie sam ich wytworzyć i muszą być dostarczone wraz z pożywieniem ‒ najczęściej mięsem, ale okazuje się, że owies świetnie uzupełnia to zapotrzebowanie. Wraz z produktami owsianymi do naszego organizmu dostarczane są wielonienasycone kwasy tłuszczowe ‒ ważne m.in. dla układu sercowo-naczyniowego i również wymagające dostarczenia wraz z pożywieniem. Lista właściwości odżywczych dopiero się zaczyna ‒ w owsie znajdziemy bowiem witaminy A, E, K, witaminy z grupy B, w tym B1 odpowiedzialną za prawidłowe funkcjonowanie serca, mięśni i układu nerwowego, żelazo, mangan, cynk, wapń, magnez i fosfor. Niewielka zawartość sodu sprawia, że produkty owsiane są szczególnie polecane osobom zmagającym się z nadciśnieniem. To, za co szczególnie cenimy owies, to wysoka zawartość rozpuszczalnego w wodzie błonnika pokarmowego. Beta-glukany zawarte w błonniku wchłaniają wodę, tworząc w przewodzie pokarmowym swego rodzaju śluz. Chroni on błonę śluzową żołądka i jelit przed podrażnieniami i infekcjami bakteryjnymi. Jednocześnie doskonale wypełnia przewód pokarmowy, dając długotrwałe uczucie sytości ‒ dlatego produkty owsiane są tak często polecane przez dietetyków. Badania przeprowadzone m.in. w Chinese Academy of Agricultural Sciences dowodzą, że spadek stężenia cholesterolu we krwi jest proporcjonalny do ilości spożywanych produktów owsianych i zawartych w nich beta-glukanów. Amerykańskie Stowarzyszenie Dietetyków zaleca terapię polegającą na podawaniu dziennie dawki ok. 2 g beta-glukanów, która powoduje obniżenie poziomu cholesterolu o 9,5 proc. W 100 g otrębów owsianych jest od 3 do 8 g beta-glukanu ‒ tak niewiele trzeba, żeby dbać o układ krążenia. Warto przy tym pamiętać, że błonnik rozpuszczalny w wodzie jest tzw. prebiotykiem. Jest niezbędny dla prawidłowego rozwoju dobroczynnej flory bakteryjnej w jelitach, a co za tym idzie, wpływa na odporność organizmu. Dodatkowo kwasy organiczne, które powstają w jelicie grubym na skutek rozpadu beta-glukanów pod wpływem bakterii probiotycznych, mają właściwości przeciwzapalne, przeciwbólowe i pleśniobójcze."}',
        3,
        '2021-06-20',
        '2021-07-23',
        2
);



INSERT INTO article 
(
        article_header,
        article_src,
        article_text,
        article_category_id,
        article_created,
        article_updated,
        article_owner_id
) values (
        "Nowość w Kalendarzu Google wspierająca pracę hybrydową",
        "https://1.bp.blogspot.com/-L7GRj_hzU-k/YR0dNNIfPQI/AAAAAAAAKJw/3IloCDldluMqHASC6ZhrrqFVYzj5nA03QCLcBGAsYHQ/w640-h412/Working%2Blocation%2Bin%2Bcalendar.png",
        '{"text_1" : "Google przygotował nową funkcję dla Kalendarza, która z pewnością ucieszy biznesowych użytkowników pakietu Google Workspace. Obecnie część firm nadal pracuje w modelu zdalnym lub hybrydowym. Powoduje to, że pracownicy dzielą czas pracy między dom, a firmowe biuro. Teraz aby ulepszyć komunikację i zarządzanie harmonogramem pracy pracowników, użytkownicy Kalendarza Google będą mogli oznaczyć, kiedy planują pracować stacjonarnie w biurze, a kiedy będą dostępni zdalnie z home office, np. łącząc się za pośrednictwem Google Meet."}',
        4,
        '2020-09-20',
        '2021-01-23',
        5
);

INSERT INTO article 
(
        article_header,
        article_src,
        article_text,
        article_category_id,
        article_created,
        article_updated,
        article_owner_id
) values (
        "Kogo obchodzi cyberbezpieczeństwo",
        "https://www.telepolis.pl/images/2020/09/Projekt-ustawy-o-krajowym-systemie-cyberbezpieczenstwa-1200-1.jpg",
        '{"text_1": "Cyberbezpieczeństwo jest szerokim zagadnieniem. Dziwi zatem, że temat rzadko jest w Polsce rozważany na poważnie. Dziś to głównie dziedzina technologii, polityki technologii i polityki bezpieczeństwa, ale cyberbezpieczeństwo oddziałuje też na gospodarkę, biznes, infrastrukturę krytyczną, bezpieczeństwo wewnętrzne i zewnętrzne, wojsko, a nawet stosunki międzynarodowe. Podczas wrześniowej sesji prac grupy roboczej w ONZ Polska wyraziła opinię, że nie potrzeba nowych między narodowych traktatów stabilizujących bezpieczeństwo w kontekście ryzyka cyberataków. Szeroki zakres tematyczny w połączeniu z szybką ewolucją problemów może wywołać zawroty głowy nawet wśród ekspertów."}',
        2,
        '2019-10-20',
        '2020-11-23',
        1
);


INSERT INTO article 
(
        article_header,
        article_src,
        article_text,
        article_category_id,
        article_created,
        article_updated,
        article_owner_id
) values (
        "Prezydent dostanie 40 proc. podwyżki. Sejm podjął decyzję",
        "https://www.prezydent.pl/gfx/prezydent/userfiles3/images/.prezydent./do_pobrania/zaakceptowane2019/0152.jpg",
        '{"text_1" : "Sejm przyjął dwie z czterech uchwalonych przez Senat poprawek do ustawy o wynagrodzeniu osób zajmujących kierownicze stanowiska państwowe. Poprawki te dotyczą doprecyzowania niektórych zasad naliczania wynagrodzeń. Ustawa przyznaje podwyżki m.in. samorządowcom oraz prezydentowi. Głowa państwa zarobi dzięki nim o 40 proc. więcej.Podczas piątkowych obrad Sejm głosował nad przyjęciem bądź odrzuceniem zgłoszonych przez Senat poprawek do uchwalonej w sierpniu nowelizacji ustawy o wynagrodzeniu osób zajmujących kierownicze stanowiska państwowe. Sejmowa Komisja Finansów publicznych zaopiniowała przyjęcie dwóch z czterech senackich poprawek, które doprecyzowały zasady naliczania wynagrodzeń dla wymienionych w ustawie osób zajmujących kierownicze stanowiska państwowe. Nowelizacja ustawy o wynagrodzeniu osób zajmujących kierownicze stanowiska państwowe została uchwalona przez Sejm 11 sierpnia. Dokonuje ona zmian w systemie wynagradzania prezydenta oraz byłych prezydentów, a także zasad ustalania maksymalnej wysokości diet lub wynagrodzeń w samorządzie terytorialnym wszystkich szczebli."}',
        5,
        '2021-05-20',
        '2021-06-23',
        5
);

INSERT INTO article 
(
        article_header,
        article_src,
        article_text,
        article_category_id,
        article_created,
        article_updated,
        article_owner_id
) values (
        "Sposób na ślimaka. Jak się go pozbyć z ogrodu?",
        "https://www.prezydent.pl/gfx/prezydent/userfiles3/images/.prezydent./do_pobrania/zaakceptowane2019/0152.jpg",
        '{"text_1" :"Zacznijmy od tego, że nie wszystkie ślimaki można uznać za szkodniki. Te z muszelkami są raczej niegroźne. Większość jest nawet pod ochroną. Natomiast głównymi niszczycielami naszych grządek i klombów są ślimaki nagie lądowe, których w Polsce żyje około 30 gatunków. Co ciekawe one też posiadają skorupę. Ukrytą wewnątrz ciała, pod skórą. Naukowe nazwy najbardziej łakomych to m.in. ślinik pospolity i wielki, pomrowik plamisty. Jak je rozpoznać? Ślinik pospolity (Arion vulgaris) – nierzadko mylnie opisywany jako ślinik luzytański, który w Polsce nie występuje) – jako dorosły osobnik ma zwykle ceglaste aż po brunatne ubarwienie (kolor zależy od jedzenia i miejsca bytowania) i może osiągnąć nawet 12 centymetrów długości. Bardzo podobny i dla laika trudny do odróżnienia jest ślinik wielki (Arion rufus), ale jest większy i może mierzyć do 15 centymetrów. Pomrowik plamisty (Deroceras reticulatum) ma maksymalnie 4,5 centymetra długości, zabarwienie kremowe, a jego znakami rozpoznawczymi są brunatne lub czarne plamki zarówno na płaszczu, jak i po bokach."}',
        4,
        '2021-07-20',
        '2021-07-23',
        3
);

INSERT INTO article 
(
        article_header,
        article_src,
        article_text,
        article_category_id,
        article_created,
        article_updated,
        article_owner_id
) values (
        "Wampir z Krakowa - potwór, przed którym drżało całe miasto",
        "https://www.prezydent.pl/gfx/prezydent/userfiles3/images/.prezydent./do_pobrania/zaakceptowane2019/0152.jpg",
        '{"text_1" : "Karol Kot urodził się 18 grudnia 1946 r. w Krakowie. Wychowywał się w inteligenckiej rodzinie na krakowskim Kazimierzu, w kamienicy nr 2 przy ul. Meiselsa. Karol nie chodził do przedszkola, ponieważ rodziców stać było na to, aby uczyć go samodzielnie. Chłopca, między pracą a domowymi obowiązkami, wychowywała matka. Kiedy Karol skończył osiem lat, na świat przyszła jego młodsza siostra. Karol od momentu, kiedy zauważył, że rodzice zaczęli ją faworyzować, regularnie znęcał się nad swoją siostrą. Był to czas, w którym Karol po raz pierwszy zaczął używać przemocy wobec drugiego człowieka. Czując się niekochany przez rodziców, chłopiec zaczął uciekać w świat chorych fantazji o znęcaniu się nad kobietami."}',
        4,
        '2021-02-20',
        '2021-04-23',
        3
);


INSERT INTO article 
(
        article_header,
        article_src,
        article_text,
        article_category_id,
        article_created,
        article_updated,
        article_owner_id
) values (
        "Szef OZZL: Będą nas leczyli ludzie, którzy są 60 godzinę w pracy",
        "https://www.prezydent.pl/gfx/prezydent/userfiles3/images/.prezydent./do_pobrania/zaakceptowane2019/0152.jpg",
        '{"text_1" : "Niech pójdą do jakiegoś szpitala i powiedzą to lekarzom prosto w twarz. W szpitalnictwie jest tak mało pieniędzy, że cudem jest, iż to jeszcze funkcjonuje. Nie ma mydła w łazienkach, klimatyzacja w gabinetach lekarskich, a nieraz nawet na salach operacyjnych jest luksusem. Cieszymy się, że jest papier toaletowy. Lekarze zatrudnieni na umowę o pracę otrzymują zatem - podobnie jak ja - minimalną płacę ustawową dla lekarzy, czyli obecnie 6769 zł pensji zasadniczej. Minister zdrowia Adam Niedzielski w wywiadzie z WP wskazał, że lekarz zarabia średnio 25 tys. zł miesięcznie, a mediana wynosi 16,6 tys. zł miesięcznie. Godnie. Klasyczna manipulacja. Minister zdrowia podaje dane z PIT-ów, w których uwzględnione są zarobki ze wszystkich źródeł. W tej statystyce są uwzględnieni też przedsiębiorcy-lekarze, np. właściciele klinik. Ale przecież nikt nie mówi, że lekarz nie jest w stanie dobrze zarobić. My mówimy, że lekarz, aby dobrze zarobić, musi pracować po 300-350 godzin miesięcznie. Musi pracować w kilku miejscach, dorabiać. Być cały czas zmęczony."}',
        1,
        '2019-02-20',
        '2020-04-23',
        2
);

INSERT INTO article 
(
        article_header,
        article_src,
        article_text,
        article_category_id,
        article_created,
        article_updated,
        article_owner_id
) values (
        "Mocny komentarz po brązowym medalu Polaków. 'Sukcesu nie odnieśliśmy' ",
        "https://www.prezydent.pl/gfx/prezydent/userfiles3/images/.prezydent./do_pobrania/zaakceptowane2019/0152.jpg",
        '{"text_1" : "To, co przede wszystkim zostanie w pamięci polskich kibiców, to efektowna wygrana 3:0 z Serbami na koniec turnieju. Olbrzymie wrażenie zrobiło też pewne zwycięstwo z Rosjanami. Reprezentacja Polski podczas całego turnieju, którego była współgospodarzem, przegrała tyko jedno spotkanie. W półfinale ze Słowenią - 1:3. Jednak to właśnie ta porażka sprawiła, że Polacy nie mogli walczyć w meczu o tytuł. - Obecny trener bądź jego następca musi się zastanowić, czy drużyna dotrwa w takiej formie do igrzysk za trzy lata. Mamy najlepszych zawodników na świecie, a w pewnych momentach nie stanowią drużyny. Czy w takiej formie ten zespół przetrwa? Może być kłopot - twierdzi Bosek w rozmowie z WP SportoweFakty."}',
        2,
        '2020-03-20',
        '2020-04-23',
        1
);

INSERT INTO article 
(
        article_header,
        article_src,
        article_text,
        article_category_id,
        article_created,
        article_updated,
        article_owner_id
) values (
        "Kradną paliwo na stacjach. 'Zatankował za 800 zł, zapłacił za hot doga i odjechał' ",
        "https://www.prezydent.pl/gfx/prezydent/userfiles3/images/.prezydent./do_pobrania/zaakceptowane2019/0152.jpg",
        '{"text_1" : "Są stacje na których, do kradzieży paliwa dochodzi nagminnie, nawet trzy - cztery razy w miesiącu. Kierowca podjeżdża, tankuje do pełna, zakręci się na stacji, czasem nawet kupi jakiś drobiazg. Wraca do auta i odjeżdża. Według danych Polskiej Organizacji Przemysłu i Handlu Naftowego w Polsce co roku dochodzi do około 100 tysięcy przypadków kradzieży na stacjach benzynowych, w tym tzw. sklepowych. Łupem złodziei pada paliwo o wartości 20 mln zł. - Robią to \\"na bezczela\\". Maseczka na twarzy, w końcu pandemia. Okulary, bo słońce w drodze przeszkadza. Kiedyś to przykręcali kradzione tablice, albo zaklejali je fałszywymi numerami, teraz nawet tego się im nie chce. Jeśli nawet stacja ma monitoring, to na niewiele się zda. Karalność jest tak niska, że złodzieje się nie boją - relacjonuje pan Tomasz, kierownik kilku stacji prywatnej sieci na Dolnym Śląsku."}',
        5,
        '2021-07-20',
        '2021-07-23',
        4
);

INSERT INTO article 
(
        article_header,
        article_src,
        article_text,
        article_category_id,
        article_created,
        article_updated,
        article_owner_id
) values (
        "'To nowość w występach Szczęsnego'. Włosi piszą o cudzie z udziałem polskiego bramkarza",
        "https://www.prezydent.pl/gfx/prezydent/userfiles3/images/.prezydent./do_pobrania/zaakceptowane2019/0152.jpg",
        '{"text_1" : "Po serii niezbyt udanych meczów, polski bramkarz znów przypomniał fanom Juventusu, że jest fachowcem w swojej pracy. Zresztą ci przywitali go niezwykle gorąco przed klasykiem Serie A z Milanem (1:1). \\"Stara Dama\\" doskonale zaczęła, bo już w 4 minucie trafił Alvaro Morata. Długo goście nie mogli doprowadzić do remisu. Udało się to po trafieniu Ante Rebicia po rzucie rożnym w 76. minucie - Szczęsny był bez szans."}',
        3,
        '2021-04-23',
        '2021-04-23',
        2
);

INSERT INTO article 
(
        article_header,
        article_src,
        article_text,
        article_category_id,
        article_created,
        article_updated,
        article_owner_id
) values (
        " 'Fakty' inne niż zwykle. Wyraźny sygnał dla widzów TVN24",
        "https://www.prezydent.pl/gfx/prezydent/userfiles3/images/.prezydent./do_pobrania/zaakceptowane2019/0152.jpg",
        '{"text_1" : "Prowadząca \\"Faktów\\" Diana Rudnik w niedzielę 18 września zakończyła wydanie inaczej niż zwykle. Dziennikarka przypomniała,że do wygaśnięcia koncesji TVN24 pozostał tydzień. Po chwili na ekranach pojawiła się czarna plansza z tą informacją. Przypomnijmy, że TVN24 od 19 miesięcy zabiega, aby Krajowa Radia Radiofonii i Telewizji przyznała jej rekoncesję. Oficjalnie 26 września dotychczasowa koncesja straci ważność. Włodarze stacji zadbali już o pozyskanie holenderskiej koncesji, która miałaby umożliwić im kontynuowanie nadawania, lecz cały czas oczekują na decyzję polskiego podmiotu."}',
        1,
        '2020-09-20',
        '2021-01-23',
        1
);

INSERT INTO article 
(
        article_header,
        article_src,
        article_text,
        article_category_id,
        article_created,
        article_updated,
        article_owner_id
) values (
        "Wybory w Rosji. Rośnie wynik partii Putina. Opozycja: oszustwo",
        "https://www.prezydent.pl/gfx/prezydent/userfiles3/images/.prezydent./do_pobrania/zaakceptowane2019/0152.jpg",
        '{"text_1" :"Po przeliczeniu 70 proc. głosów w wyborach do Dumy Państwowej rządząca partia Jedna Rosja zdobywa ponad 48 proc. głosów. Do parlamentu wejdą jeszcze cztery partie. Na drugim miejscu jest Komunistyczna Partia Federacji Rosyjskiej, której przypadło ok. 20 proc. głosów. Kolejne miejsca zajmują: populistyczno-nacjonalistyczna Liberalno-Demokratyczna Partia Rosji, dowodzona przez Władimira Żyrinowskiego (niecałe 8 proc.), Sprawiedliwa Rosja (ok. 7,5 proc. głosów) i partia Nowi Ludzie (nieco ponad 5 proc.). Opozycja skupiona wokół Aleksieja Nawalnego mówi o oszustwie wyborczym."}',
        1,
        '2020-11-20',
        '2020-12-23',
        4
);

INSERT INTO article 
(
        article_header,
        article_src,
        article_text,
        article_category_id,
        article_created,
        article_updated,
        article_owner_id
) values (
        "Ojciec Andrzeja Dudy o homoseksualizmie. Lawina komentarzy",
        "https://www.prezydent.pl/gfx/prezydent/userfiles3/images/.prezydent./do_pobrania/zaakceptowane2019/0152.jpg",
        '{"text_1" : " \\"Człowiek powinien pracować nad sobą, zdawać sobie sprawę z tego, jakie są konsekwencje jego uwarunkowań naturalnych i starać się wykorzystać predyspozycje biologiczne, by osiągać to, czego większość z nas chce, czyli mieć ciepły dom, dzieci, rodzinę\\" - mówił w wywiadzie dla \\"Newsweeka\\" prof. Jan Duda, przewodniczący Sejmiku Województwa Małopolskiego, a prywatnie ojciec prezydenta Andrzeja Dudy. Powołał się na badanie, opublikowane w \\"Science Magazine\\", z którego wynika, że tylko od 8 do 25 proc. osób uzasadnia swoje skłonności nieheteronormatywne przyczynami genetycznymi, reszta ma zależeć od czynników kulturalnych lub związanych z hormonami. Na tej podstawie stwierdził, że \\"czynniki kulturowe to efekty promowania tych skłonności\\". \\"Po prostu homoseksualizm jest w znacznym stopniu zjawiskiem zaraźliwym. Twierdzenie, że płeć to jest kwestia wyboru, które staje się u nas modne, utrudnia dzieciom rozwój psychofizyczny \\"- mówił dalej."}',
        1,
        '2021-05-20',
        '2021-05-23',
        2
);

INSERT INTO article 
(
        article_header,
        article_src,
        article_text,
        article_category_id,
        article_created,
        article_updated,
        article_owner_id
) values (
        "Doskonały przepis na ziemniaki pieczone w jogurcie",
        "https://www.prezydent.pl/gfx/prezydent/userfiles3/images/.prezydent./do_pobrania/zaakceptowane2019/0152.jpg",
        '{"text_1" : "Propozycja na pyszny obiad lub kolację bez ani grama tłuszczu. Tak przygotowane ziemniaki są też idealnym dodatkiem do każdego mięsa. Sekretnym składnikiem tego dnia jest jogurt naturalny, w którym obtacza się warzywo przed upieczeniem. Potrzebny będzie także rękaw do pieczenia. Ważne jest, aby nożykiem zrobić kilka malutkich dziurek w folii. Następnie wstawiamy do piekarnika rozgrzanego do 180 stopni z termoobiegiem i pieczemy przez ok 45 min. Rozcinamy rękaw od góry i pieczemy jeszcze ok 15-20 minut. Wszystko do momentu aż ziemniaki się ładnie przyrumienią. I gotowe! Chcesz poznać więcej przepisów, zajrzyj na Swojskie jedzonko.","text_2" : "Propozycja na pyszny obiad lub kolację bez ani grama tłuszczu. Tak przygotowane ziemniaki są też idealnym dodatkiem do każdego mięsa. Sekretnym składnikiem tego dnia jest jogurt naturalny, w którym obtacza się warzywo przed upieczeniem. Potrzebny będzie także rękaw do pieczenia. Ważne jest, aby nożykiem zrobić kilka malutkich dziurek w folii. Następnie wstawiamy do piekarnika rozgrzanego do 180 stopni z termoobiegiem i pieczemy przez ok 45 min. Rozcinamy rękaw od góry i pieczemy jeszcze ok 15-20 minut. Wszystko do momentu aż ziemniaki się ładnie przyrumienią. I gotowe! Chcesz poznać więcej przepisów, zajrzyj na Swojskie jedzonko."}',
        2,
        '2021-02-20',
        '2021-04-23',
        1
);

INSERT INTO article_comment 
(
        comment_for_article_id,
        comment_owner_id,
        comment
) values (
        1,
        1,
        "Świetny blog !"
);

INSERT INTO article_comment 
(
        comment_for_article_id,
        comment_owner_id,
        comment
) values (
        1,
        4,
        "Świetny blog !"
);

INSERT INTO article_comment 
(
        comment_for_article_id,
        comment_owner_id,
        comment
) values (
        1,
        4,
        "Świetny blog !"
);

INSERT INTO article_comment 
(
        comment_for_article_id,
        comment_owner_id,
        comment
) values (
        2,
        1,
        "Świetny blog !"
);

INSERT INTO article_comment 
(
        comment_for_article_id,
        comment_owner_id,
        comment
) values (
        2,
        2,
        "Świetny blog !"
);

INSERT INTO article_comment 
(
        comment_for_article_id,
        comment_owner_id,
        comment
) values (
        2,
        4,
        "Świetny blog !"
);

INSERT INTO article_comment 
(
        comment_for_article_id,
        comment_owner_id,
        comment
) values (
        2,
        5,
        "Świetny blog !"
);

INSERT INTO article_comment 
(
        comment_for_article_id,
        comment_owner_id,
        comment
) values (
        3,
        2,
        "Świetny blog !"
);

INSERT INTO article_comment 
(
        comment_for_article_id,
        comment_owner_id,
        comment
) values (
        3,
        1,
        "Świetny blog !"
);

INSERT INTO article_comment 
(
        comment_for_article_id,
        comment_owner_id,
        comment
) values (
        3,
        4,
        "Świetny blog !"
);

INSERT INTO article_comment 
(
        comment_for_article_id,
        comment_owner_id,
        comment
) values (
        3,
        3,
        "Świetny blog !"
);

INSERT INTO article_comment 
(
        comment_for_article_id,
        comment_owner_id,
        comment
) values (
        4,
        2,
        "Świetny blog !"
);

INSERT INTO article_comment 
(
        comment_for_article_id,
        comment_owner_id,
        comment
) values (
        4,
        1,
        "Świetny blog !"
);

INSERT INTO article_comment 
(
        comment_for_article_id,
        comment_owner_id,
        comment
) values (
        4,
        5,
        "Świetny blog !"
);

INSERT INTO article_comment 
(
        comment_for_article_id,
        comment_owner_id,
        comment
) values (
        5,
        4,
        "Świetny blog !"
);

INSERT INTO article_comment 
(
        comment_for_article_id,
        comment_owner_id,
        comment
) values (
        5,
        1,
        "Świetny blog !"
);

INSERT INTO article_comment 
(
        comment_for_article_id,
        comment_owner_id,
        comment
) values (
        6,
        1,
        "Świetny blog !"
);

INSERT INTO article_comment 
(
        comment_for_article_id,
        comment_owner_id,
        comment
) values (
        6,
        3,
        "Świetny blog !"
);

INSERT INTO article_comment 
(
        comment_for_article_id,
        comment_owner_id,
        comment
) values (
        6,
        4,
        "Świetny blog !"
);

INSERT INTO article_comment 
(
        comment_for_article_id,
        comment_owner_id,
        comment
) values (
        7,
        1,
        "Świetny blog !"
);

INSERT INTO article_comment 
(
        comment_for_article_id,
        comment_owner_id,
        comment
) values (
        7,
        3,
        "Świetny blog !"
);

INSERT INTO article_comment 
(
        comment_for_article_id,
        comment_owner_id,
        comment
) values (
        8,
        2,
        "Świetny blog !"
);

INSERT INTO article_comment 
(
        comment_for_article_id,
        comment_owner_id,
        comment
) values (
        8,
        5,
        "Świetny blog !"
);

INSERT INTO article_comment 
(
        comment_for_article_id,
        comment_owner_id,
        comment
) values (
        9,
        3,
        "Świetny blog !"
);

INSERT INTO article_comment 
(
        comment_for_article_id,
        comment_owner_id,
        comment
) values (
        9,
        2,
        "Świetny blog !"
);

INSERT INTO article_comment 
(
        comment_for_article_id,
        comment_owner_id,
        comment
) values (
        10,
        1,
        "Świetny blog !"
);

INSERT INTO article_comment 
(
        comment_for_article_id,
        comment_owner_id,
        comment
) values (
        10,
        2,
        "Świetny blog !"
);

INSERT INTO article_comment 
(
        comment_for_article_id,
        comment_owner_id,
        comment
) values (
        11,
        3,
        "Świetny blog !"
);

INSERT INTO article_comment 
(
        comment_for_article_id,
        comment_owner_id,
        comment
) values (
        11,
        1,
        "Świetny blog !"
);

INSERT INTO article_comment 
(
        comment_for_article_id,
        comment_owner_id,
        comment
) values (
        12,
        3,
        "Świetny blog !"
);

INSERT INTO article_comment 
(
        comment_for_article_id,
        comment_owner_id,
        comment
) values (
        12,
        6,
        "Świetny blog !"
);

INSERT INTO article_comment 
(
        comment_for_article_id,
        comment_owner_id,
        comment
) values (
        13,
        6,
        "Świetny blog !"
);

INSERT INTO article_comment 
(
        comment_for_article_id,
        comment_owner_id,
        comment
) values (
        13,
        2,
        "Świetny blog !"
);

INSERT INTO article_comment 
(
        comment_for_article_id,
        comment_owner_id,
        comment
) values (
        14,
        1,
        "Świetny blog !"
);

INSERT INTO article_comment 
(
        comment_for_article_id,
        comment_owner_id,
        comment
) values (
        14,
        2,
        "Świetny blog !"
);

INSERT INTO article_comment 
(
        comment_for_article_id,
        comment_owner_id,
        comment
) values (
        14,
        3,
        "Świetny blog !"
);