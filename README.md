Užduotis yra paleidžiama komandinės eilutės pagalba:

> php skaiciuokle.php < input.csv

Kol kas klaidingai skaičiuoja 7-9 (skaičiuojant nuo vieneto, ne nulio) elementus (komisinius). Taip yra todėl, kad neįvertinau to, kad kai kurios datos yra vienodos ir todėl skaičiuojant kaupamąsias sumas, skaičiuotuvas paima vieną ar kelis elementus, kurių neturėtų. Netrukus bandysiu ištaisyti šią klaidą ir atsiūsti pataisymą.

Užduoties sprendimas atliekamas sekančiais etapais:

input.csv failo duomenų pagalba sukuriamas masyvas su faile esančiais duomenimis;
masyvui pridedami papildomi informacijos elementai, kurie reikalingi komisinių skaičiavimams;
atliekami kominisinių skaičiavimai.
Užduotis atliekama nenaudojant programavimo karkasų, nes tai įtakotų greitaveiką, o ir užduoties specifikai to nereikia. Reikalinga klasė "Fee" ir du papildomi failai "functions.php" ir "currencies.php" yra užkraunami composer pagalba. Taip yra užkrauta ir phpunit modulis, kad būtų galima atlikti testus. Jų padaryti nespėjau.