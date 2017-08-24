Užduotis yra paleidžiama komandinės eilutės pagalba:

> php skaiciuokle.php < input.csv

Užduoties sprendimas atliekamas sekančiais etapais:

input.csv failo duomenų pagalba sukuriamas masyvas su faile esančiais duomenimis;
masyvui pridedami papildomi informacijos elementai, kurie reikalingi komisinių skaičiavimams;
atliekami kominisinių skaičiavimai.
Užduotis atliekama nenaudojant programavimo karkasų, nes tai įtakotų greitaveiką, o ir užduoties specifika to nereikalauja. Naudojama klasė "Fee" ir du papildomi failai "functions.php" bei "currencies.php" yra užkraunami composer pagalba. Taip pat yra užkrautas ir phpunit modulis, kad būtų galima atlikti testus. Jų padaryti nespėjau.