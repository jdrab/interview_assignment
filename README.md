# Zadanie - Diskusia

- Vytvorte diskusiu pod fiktívny článok. 
- Do diskusie môže prispievať
ktokoľvek, pričom sa dá reagovať na jednotlivé komentáre. Komentár musí
obsahovať autora, dátum pridania a samotný text.

- Nad touto diskusiou vytvorte administračné rozhranie kde bude mať prístup
iba oprávnená osoba a bude vedieť tieto komentáre zmazať, upraviť alebo
vytvoriť reakciu na akýkoľvek komentár.

- Pri implementácii sa sústreďte na softvérový návrh, bezpečnosť riešenia a
dátovú udržateľnosť.
Zaujíma nás Váš prístup k OOP a čistote kódu.

- Formát výstupu: Link pre verejný repozitár.


### použité
- ako zaklad slim4 s pokusom o implementaciu ADR
- php-di ako dependency injektor
- primitivny autorizacny middleware a najivne sessions
- nativne templates s pouzitim plates, sablony su trochu hnusne lebo <?= ?>
- phinx pre migracie a seed databazy
- ~~codecept pre acceptance testing~~
- slim/csrf

### co som vobec neriesil
- strankovanie ku komentarom
- nestihol som zdokumentovat a aspon acceptance testy, hence the ~~codecept~~

### sfunkcnenie
- php8 (lebo pouzivam minimalne union typy pre navratove hodnoty funkcii kde-tu)
- nastavit v db.env
- podla nastavenia environmentu vytvorit usera a db a nastavit to do config/database.php
- composer install
- php vendor/bin/phinx migrate
- php vendor/bin/phinx seed:run
- php -S localhost:8000 -t public
- v config/session.php su uvedene defaultne prihlasovacie udaje admin:admin
