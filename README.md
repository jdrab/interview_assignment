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


### co je pod kapotou
- zaklad slim4
- php-di ako dependency injektor
- nativne templates s pouzitim plates
- phinx pre acceptance testing
- komplexnejsiu validaciu vstupov by som pravdepodobne riesil cez cake validator

### co sa da zlepsit
- strankovanie ku komentarom
- index nad comments.thread_id robi sa viac operacii, ktore to vyuziju (max aj order by)
- pri vytvarani commentov sa da pouzit pri zapise abstract factory na vytvaranie
  objektu comment a nasledne aj validacia objektu cez filter
