## Informacje o Projekcie

### Przydatne linki
- link do repozytorium na github: **[github.com/attensione/web24](https://github.com/attensione/web24)**
- link do deploya api: **[dev.aone.ovh/api](https://dev.aone.ovh/api)**

### Treść zadania
Zadanko, 2/3 dni:
REST API Utwórz REST API przy użyciu frameworka Laravel / Symfony. Celem aplikacji jest umożliwienie przesłania przez użytkownika informacji odnośnie firmy(nazwa, NIP, adres, miasto, kod pocztowy) oraz jej pracowników(imię, nazwisko, email, numer telefonu(opcjonalne)) - wszystkie pola są obowiązkowe poza tym które jest oznaczone jako opcjonalne. Uzupełnij endpointy do pełnego CRUDa dla powyższych dwóch. Zapisz dane w bazie danych. PS. Stosuj znane Ci dobre praktyki wytwarzania oprogramowania oraz korzystaj z repozytorium kodu.

### Zastosowane rozwiązanie
Użyta w projekcie baza danych to SQLite

### endpointy
USER:
Logowanie użytkownika: https://dev.aone.ovh/api/login //dodany użytkownik testowy login: test@aone.pl pass: test
Rejestracja nowego użytkownika: https://dev.aone.ovh/api/register
INFO - Pobieramy token i nim się logujemy do dalszych API używając Autoryzacji Bearer Token
FIRMY:
Pobieranie wszystkich firm przez GET: https://dev.aone.ovh/api/v1/companies //ten pierwszy endpoint do zamkniecia po zakonczeniu testow na frontendzie
Wyświetlanie danej firmy po id przez GET: https://dev.aone.ovh/api/v1/companies/{id_firmy}
Zapisywanie nowych firm przez POST: https://dev.aone.ovh/api/v1/companies
Aktualizacja danych firm przez PATCH: https://dev.aone.ovh/api/v1/companies/{id_firmy}
Usuwanie firmy przez DELETE: https://dev.aone.ovh/api/v1/companies/{id_firmy}
PRACOWNICY:
Pobieranie wszystkich pracowników dla danej firmy metoda GET: https://dev.aone.ovh/api/v1/companies/{id_firmy}/employees
Pobieranie konkretnego pracownika: https://dev.aone.ovh/api/v1/companies/{id_firmy}/employees/{id_pracownika}
Zapisywanie nowego pracownika metoda POST: https://dev.aone.ovh/api/v1/companies/{id_firmy}/employees
Aktualizacja danych pracownika przez PATCH: https://dev.aone.ovh/api/v1/companies/{id_firmy}/employees/{id_pracownika}
Usuwanie pracownika przez DELETE: https://dev.aone.ovh/api/v1/companies/{id_firmy}/employees/{id_pracownika}

### Tworzenie firmy
curl -X POST http://localhost/api/v1/companies \
-H "Content-Type: application/json" \
-d '{
"name": "Example Corp",
"nip": "1234567890",
"address": "ul. Testowa 123",
"city": "Warszawa",
"postal_code": "00-001"
}'

### Pobieranie pracowników firmy
curl http://localhost/api/v1/companies/1/employees
