Užduotis yra paleidžiama komandinės eilutės pagalba:

> php skaiciuokle.php < input.csv

Kol kas klaidingai skaičiuoja 8-9 (skaičiuojant nuo vieneto, ne nulio) elementus (komisinius).
Ieškau klaidos, pataisęs atsiūsiu.

Užduoties sprendimas atliekamas sekančiais etapais:

input.csv failo duomenų pagalba sukuriamas masyvas su faile esančiais duomenimis;
masyvui pridedami papildomi informacijos elementai, kurie reikalingi komisinių skaičiavimams;
atliekami kominisinių skaičiavimai.
Užduotis atliekama nenaudojant programavimo karkasų, nes tai įtakotų greitaveiką, o ir užduoties specifika to nereikalauja. Naudojama klasė "Fee" ir du papildomi failai "functions.php" bei "currencies.php" yra užkraunami composer pagalba. Taip pat yra užkrautas ir phpunit modulis, kad būtų galima atlikti testus. Jų padaryti nespėjau.