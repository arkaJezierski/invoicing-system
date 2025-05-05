# 🧾 Plan Rozwoju Aplikacji Fakturująco-Księgowej

---

## ✅ Moduły Główne

### 1. Kontrahenci
- [ ] CRUD kontrahentów
- [ ] Walidacja NIP (GUS API)
- [ ] Powiązania z fakturami i płatnościami
- [ ] Kategoryzacja (klient / dostawca)

---

### 2. Cennik / Towary
- [ ] CRUD towarów i usług
- [ ] GTU kody (dla JPK)
- [ ] Obsługa VAT i jednostek
- [ ] Ceny netto / brutto

---

### 3. Administracja
- [ ] Zarządzanie użytkownikami
- [ ] Role i uprawnienia (Spatie Permissions)
- [ ] Uwierzytelnianie 2FA
- [ ] Audyt działań

---

### 4. Kursy Walut
- [ ] Pobieranie kursów z NBP API
- [ ] Historia kursów
- [ ] Przypisanie kursu do faktur walutowych

---

## 🧾 Moduł: Faktury

### 4.1 Sprzedaż
- [ ] CRUD faktur sprzedażowych
- [ ] Generowanie PDF/XML
- [ ] Powiązania z klientami, płatnościami
- [ ] Automaty księgowe

### 4.2 Zakup
- [ ] CRUD faktur kosztowych
- [ ] Powiązanie z kontrahentami i kontami
- [ ] Księgowanie do ewidencji VAT

### 4.3 Raport JPK
- [ ] Eksport JPK_V7M / JPK_V7K
- [ ] Walidacja danych (XSD)
- [ ] Archiwizacja plików XML
- [ ] Historia eksportów

### 4.4 Eksport KSeF
- [ ] Tokenizacja dostępu
- [ ] Podpisywanie i wysyłka XML
- [ ] Obsługa UPO
- [ ] Monitoring statusów

---

## 📚 Moduł: Księgowość

### 5.1 Plan Kont
- [ ] CRUD kont księgowych
- [ ] Hierarchia kont (syntetyczne/analityczne)
- [ ] Powiązanie z zapisami i fakturami

### 5.2 Dekretacja
- [ ] Generowanie zapisów księgowych z faktur
- [ ] Manualne korekty dekretów
- [ ] Powiązanie z okresem rozliczeniowym

### 5.3 Ewidencja VAT
- [ ] Sprzedaż / zakup
- [ ] GTU i stawki VAT
- [ ] Eksport do deklaracji VAT

### 5.4 Zamknięcia Okresów
- [ ] Zamknięcie miesiąca
- [ ] Blokada edycji danych
- [ ] Raporty końcowe

---

## 💸 Moduł: Płatności
- [ ] Rejestrowanie płatności
- [ ] Powiązanie z fakturami (opłacone/nieopłacone)
- [ ] Różne metody płatności (przelew, gotówka, karta)
- [ ] Rozliczenia częściowe

---

## 📊 Moduł: Raporty i Analityka
- [ ] Raporty sprzedaży / kosztów
- [ ] Eksport danych do CSV/PDF
- [ ] Dashboardy i wykresy
- [ ] Raporty VAT / PIT

---

## 🧪 Moduł: Logi i Audyt
- [ ] Historia działań użytkownika
- [ ] Zmiany w fakturach, zapisach księgowych
- [ ] Eksport logów

---

## ✨ Etapy wdrażania (Propozycja MVP)

**Etap 1 – MVP fakturowania**
- [ ] Kontrahenci
- [ ] Towary
- [ ] Sprzedaż (faktury VAT)
- [ ] PDF
- [ ] Kursy walut
- [ ] Płatności podstawowe

**Etap 2 – KSeF + JPK**
- [ ] Eksport KSeF
- [ ] JPK_V7M
- [ ] GTU

**Etap 3 – Księgowość**
- [ ] Plan kont
- [ ] Dekretacja
- [ ] Ewidencja VAT
- [ ] Zamknięcia okresów

**Etap 4 – Raporty i bezpieczeństwo**
- [ ] Raporty
- [ ] Audyt
- [ ] Role i 2FA

---

> 📌 Plik stworzony: 2025-04-07  
> Autor: Zespół Projektowy  
> Do użytku przy planowaniu i wersjonowaniu roadmapy projektu


