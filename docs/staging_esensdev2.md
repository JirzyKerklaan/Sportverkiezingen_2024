# Deployen esensdev2.nl
Alle commands en handelingen voor het deployen / installeren van een statamic site vanuit een github repo op onze esensdev2 als 'staging'


## Schone staging installatie esensdev2 specifiek .
In dit geval gebruiken we `boiler.esensdev2.nl` als ons domein, helaas is dit een 'public' domain.  
Dus maken we ook nog een subdomein aan genaamd `staging.boiler.esensdev2.nl`, hier passen we de docroot aan naar `/domains/boiler.esensdev2.nl/staging/` via directadmin, zorg er wel voor dat deze map bestaat, we passen dit later eventueel nogmaals aan in DA

De mappen structuur op de esensdev zou nu het volgende moeten zijn
```
domains/
    |- boilerplate.esensdev2.nl/
        |- .htpasswd/
        |- private_html/
        |- public_ftp/
        |- public_html/
        |- staging/
    |- domein.esensdev2.nl/
    |- ...
```


### Opmerkingen
Ik heb wat aliases aangemaakt in `.bashrc` op onze esensdev zodat we makkelijker commands kunnen schrijven.
```
alias composer8="/usr/local/php80/bin/php ~/bin/composer/composer.phar"
alias php8="/usr/local/php80/bin/php"
```

### Op een rij
1) Maak het domein en subdomein via directadmin.
2) Maak de staging map
3) Zet de staging map als docroot van het staging subdomein
4) Zorg ervoor dat je php8 aan staat en redirect zonder WWW 
5) Vervolgens kunnen we inloggen via SSH en komen we in de home aka `~` of `/home/esedev`
6) Ga naar de staging map die we gemaakt hebben `cd ~/domains/boiler.esensdev2.nl/staging`
7) Clone de gewenste repo met `git clone --no-checkout https://github.com/Esens-Design/statamic-boiler.git tmp` *Dit cloned de repo zonder een branch te openenen in een tmp folder, we hebben alleen de .git nodig*
8) Verplaats de benodige `.git` in deze `/tmp` folder met `mv tmp/.git .`
9) Verwijder de `/tmp` folder met `rmdir tmp`
10) We kunnen er alvast voor zorgen dat git credentials worden opgeslagen op de server, dit is in het geval van deze esensdev2 waarschijnlijk al gedaan maar anders gebruiken we `git config --global credential.helper store`
11) We kunnen nu de staging branch checken en pullen met `git checkout staging && git pull`
12) Vanaf stap 6 zou een oneliner kunnen worden zoals 
```
cd ~/domains/boiler.esensdev2.nl/staging && git clone --no-checkout https://github.com/Esens-Design/statamic-boiler.git tmp && mv tmp/.git . && rmdir tmp && git config --global credential.helper store && git checkout staging && git pull
 ```
13)  Nu de git repo op de server staat kunnen we onze `.env` op de server zetten, die kunnen we aanpassen via SSH of via ftp.
14)  Daarna installeren we benodigde php dependencies met `composer8 install`
15)  Vervolgens installeren we eventuele npm packages met `npm install --only=prod`
16) Je zou eventueel de cache nog kunnen legen met `php8 please stache:refresh`
17) **LET OP**: het kan zo zijn dat de buildtools niet op de server gerunnend kunnen worden, ik raad dan ook aan alleen naar staging te pushen nadat er een `npm run prod` is gedaan.

### Tot slot
Als de repo eenmaal online staat met bovenstaande stappen kunnen nieuwe versies binnengehaald worden door middel van een simpele 
```
cd ~/domains/boiler.esensdev2.nl/staging && git pull 
```
Let wel op dat dit de huidige site overwrite, dus zorg ervoor dat staging up to date is!

**Extra veilig:** Inplaats van te vertrouwen op de .haccess in root kunnen we als docroot in directadmin kiezen voor `/domains/boiler.esensdev2.nl/staging/public/`


## Staging pushen en pullen op staging server
Tot dat we geautomatiseerde git workflow hebben moeten we voor nu als volgt in gang gaan.  
1) Zorg voor een werkende master die je op staging wil deployen 
2) Zorg ervoor dat de staging branch up to date is (en dus gepushed vanaf de server)
3) Doe `git checkout staging` en `git pull` voor de laatste staging variant
4) Merge hier de master in met `git merge master`
5) Doe `npm run prod` om productie bestanden te adden
6) doe `git add .` en `git commit -am "staging v1.2"`
7) doe een `git push`, open ssh en doe een `cd ~/domains/boiler.esensdev2.nl/staging && git pull `

## Automatiseren
We kunnen dit hele process zo goed als automatiseren, ik ben bezig met een bash script waar alleen domein + github repo aangegeven moeten worden en de rest doet hij zelf

//TODO
