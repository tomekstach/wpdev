Umowa RODO (WordPress będzie wysyłał NIP, a w odpowiedzi będzie oczekiwał informacji czy dany klient ma podpisaną umowę RODO czy nie) – metoda: DPAgreementGet
 
Komunikat:
 
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ass="http://www.assecobs.pl">
  <soapenv:Header />
  <soapenv:Body>
    <ass:DPAGREEMENTGET>
      <ass:ArrayDPAgreementGetData>
        <!--1 or more repetitions:-->
        <ass:DPAgreementGetData>
          <ass:NIPSameCyfry>7780111249</ass:NIPSameCyfry>
        </ass:DPAgreementGetData>
      </ass:ArrayDPAgreementGetData>
    </ass:DPAGREEMENTGET>
  </soapenv:Body>
</soapenv:Envelope>
 
Odpowiedź:
 
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Header />
  <soap:Body>
    <DPAGREEMENTResponse xmlns="http://www.assecobs.pl">
      <ArrayDPAgreementGetResult>
        <Status>1</Status>
        <DPAgreementGetResult>
          <NrUmowy>2018/0/0036</NrUmowy>
          <NIPSameCyfry>7780111249</NIPSameCyfry>
          <Nazwa1>SC JOHNSON SP. Z O.O.</Nazwa1>
          <Nazwa2>SC JOHNSON SP. Z O.O.</Nazwa2>
        </DPAgreementGetResult>
      </ArrayDPAgreementGetResult>
    </DPAGREEMENTResponse>
  </soap:Body>
</soap:Envelope>
 
 
Użytkownik (WordPress będzie wysylał NIP, a w odpowiedzi będzie oczekiwał informacji czy klient o podanym NIP-ie istnieje w ERP-ie) – metoda: CustomerGet
 
Komunikat:
 
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ass="http://www.assecobs.pl">
  <soapenv:Header />
  <soapenv:Body>
    <ass:CUSTOMERGET>
      <ass:ArrayCustomerGetData>
        <!--1 or more repetitions:-->
        <ass:CustomerGetData>
          <ass:NIPSameCyfry>1181612953</ass:NIPSameCyfry>
        </ass:CustomerGetData>
      </ass:ArrayCustomerGetData>
    </ass:CUSTOMERGET>
  </soapenv:Body>
</soapenv:Envelope>
 
Odpowiedź:
 
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Header />
  <soap:Body>
    <CUSTOMERGETResponse xmlns="http://www.assecobs.pl">
      <ArrayCustomerGetResult>
        <Status>1</Status>
        <CustomerGetResult>
          <NIPSameCyfry>1181612953</NIPSameCyfry>
          <Nazwa1>NET SPORT</Nazwa1>
          <Nazwa2>NET SPORT SP. ZO.O.</Nazwa2>
        </CustomerGetResult>
      </ArrayCustomerGetResult>
    </CUSTOMERGETResponse>
  </soap:Body>
</soap:Envelope>
 
 
Umowy – dodanie/aktualizacja umowy RODO – metoda: AgreementCreate
 
Komunikat:
 
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ass="http://www.assecobs.pl">
  <soapenv:Header />
  <soapenv:Body>
    <ass:AGREEMENTCREATE>
      <ass:ArrayAgreementCreateData>
        <!--1 or more repetitions:-->
        <ass:AgreementCreateData>
          <ass:NrZewn>169206</ass:NrZewn>
          <ass:Zrodlo>Wapro</ass:Zrodlo>
          <ass:NIPSameCyfry>8971782707</ass:NIPSameCyfry>
          <ass:WersjaUmowy>1</ass:WersjaUmowy>
          <ass:DataPodpisania>2019-10-01T00:00:00.000+02:00</ass:DataPodpisania>
          <!--Optional:-->
          <ass:RealizacjaOd>2019-10-07T00:00:00.000+02:00</ass:RealizacjaOd>
          <!--Optional:-->
          <ass:RealizacjaDo xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:nil="true" />
          <!--Optional:-->
          <ass:Aneks>0</ass:Aneks>
          <!--Optional:-->
          <ass:AneksDoUmowy xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:nil="true" />
          <!--Optional:-->
          <ass:OpisUmowy>Umowa powierzenia przetwarzania danych osobowych</ass:OpisUmowy>
          <!--Optional:-->
          <ass:EDOK>1</ass:EDOK>
          <!--Optional:-->
          <!--Optional:-->
          <ass:DaneKontaktoweDPO>brak</ass:DaneKontaktoweDPO>
          <!--Optional:-->
          <ass:MailDoZglaszaniaNaruszen>palczak@hechtpolska.pl</ass:MailDoZglaszaniaNaruszen>
          <!--Optional:-->
          <ass:Hosting>0</ass:Hosting>
          <!--Optional:-->
          <ass:Konserwacja>0</ass:Konserwacja>
          <!--Optional:-->
          <ass:Outsourcing>0</ass:Outsourcing>
          <!--Optional:-->
          <ass:UruchTestProg>1</ass:UruchTestProg>
          <ass:PrzekazanieDanychDoPanstwaTrzeciego>Nie przekazujemy</ass:PrzekazanieDanychDoPanstwaTrzeciego>
        </ass:AgreementCreateData>
      </ass:ArrayAgreementCreateData>
    </ass:AGREEMENTCREATE>
  </soapenv:Body>
</soapenv:Envelope>
 
 
Odpowiedź:
 
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Header />
  <soap:Body>
    <AGREEMENTCREATEResponse xmlns="http://www.assecobs.pl">
      <ArrayAgreementCreateResult>
        <Status>1</Status>
        <AgreementCreateResult>
          <NrZewn>169206x</NrZewn>
          <NrUmowy>2019/0/1330</NrUmowy>
        </AgreementCreateResult>
      </ArrayAgreementCreateResult>
    </AGREEMENTCREATEResponse>
  </soap:Body>
</soap:Envelope>
 
 
Biura rachunkowe Wapro – metoda AccountingOfficeCreate
 
Komunikat:
 
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ass="http://www.assecobs.pl">
  <soapenv:Header />
  <soapenv:Body>
    <ass:ACCOUNTINGOFFICECREATE>
      <ass:ArrayAccountingOfficeCreateData>
        <!--1 or more repetitions:-->
        <ass:AccountingOfficeCreateData>
          <ass:Id>189979</ass:Id>
          <!--Optional:-->
          <ass:NazwaFirmy>NIKITA FIRST</ass:NazwaFirmy>
          <!--Optional:-->
          <ass:Ulica>Aleje Jerozolimskie</ass:Ulica>
          <!--Optional:-->
          <ass:NumerUlicy>125/127</ass:NumerUlicy>
          <!--Optional:-->
          <ass:KodP>02017</ass:KodP>
          <!--Optional:-->
          <ass:Miejscowosc>Warszawa</ass:Miejscowosc>
          <!--Optional:-->
          <ass:Wojewodztwo>87</ass:Wojewodztwo>
          <!--Optional:-->
          <ass:NIP>8960005673</ass:NIP>
          <!--Optional:-->
          <ass:NIPCyfry>8960005673</ass:NIPCyfry>
          <!--Optional:-->
          <ass:Telefon>690956595</ass:Telefon>
          <!--Optional:-->
          <ass:Email>nikitafirstpl@gmail.com</ass:Email>
          <!--Optional:-->
          <ass:Imie>DEMETRIUS</ass:Imie>
          <!--Optional:-->
          <ass:Nazwisko>SUVOROV</ass:Nazwisko>
          <!--Optional:-->
          <ass:DataRejestracji>2019-06-13T00:00:00.000+02:00</ass:DataRejestracji>
          <!--Optional:-->
          <ass:DataUmowy xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:nil="true" />
          <!--Optional:-->
          <ass:DataAkceptacji>2019-06-17T00:00:00.000+02:00</ass:DataAkceptacji>
          <!--Optional:-->
          <ass:DataWycofaniaAkceptacji xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:nil="true" />
          <!--Optional:-->
          <ass:Aktywny>1</ass:Aktywny>
        </ass:AccountingOfficeCreateData>
      </ass:ArrayAccountingOfficeCreateData>
    </ass:ACCOUNTINGOFFICECREATE>
  </soapenv:Body>
</soapenv:Envelope>
 
Odpowiedź:
 
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Header />
  <soap:Body>
    <ACCOUNTINGOFFICECREATEResponse xmlns="http://www.assecobs.pl">
      <ArrayAccountingOfficeCreateResult>
        <Status>1</Status>
        <AccountingOfficeCreateResult>
          <Id>189979</Id>
          <IdERP>1147920467</IdERP>
        </AccountingOfficeCreateResult>
      </ArrayAccountingOfficeCreateResult>
    </ACCOUNTINGOFFICECREATEResponse>
  </soap:Body>
</soap:Envelope>
 
Klienci Biur rachunkowych Wapro – metoda: AccountingOfficeClientCreate
 
Komunikat:
 
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ass="http://www.assecobs.pl">
  <soapenv:Header />
  <soapenv:Body>
    <ass:ACCOUNTINGOFFICECLIENTCREATE>
      <ass:ArrayAccountingOfficeClientCreateData>
        <!--1 or more repetitions:-->
        <ass:AccountingOfficeClientCreateData>
          <ass:Id>70375</ass:Id>
          <ass:IdBiura>70369</ass:IdBiura>
          <!--Optional:-->
          <ass:NipSameCyfry>5211958211</ass:NipSameCyfry>
          <!--Optional:-->
          <ass:Email>krzysztof.stachyra@assecobs.pl</ass:Email>
          <!--Optional:-->
          <ass:StatusKlient>N</ass:StatusKlient>
          <!--Optional:-->
          <ass:DataDodania>2013-12-13T00:00:00.000+02:00</ass:DataDodania>
          <!--Optional:-->
          <ass:DataModyfikacji>2014-05-26T00:00:00.000+02:00</ass:DataModyfikacji>
          <!--Optional:-->
          <ass:Aktywny>1</ass:Aktywny>
        </ass:AccountingOfficeClientCreateData>
      </ass:ArrayAccountingOfficeClientCreateData>
    </ass:ACCOUNTINGOFFICECLIENTCREATE>
  </soapenv:Body>
</soapenv:Envelope>
 
Odpowiedź:
 
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Header />
  <soap:Body>
    <ACCOUNTINGOFFICECLIENTCREATEResponse xmlns="http://www.assecobs.pl">
      <ArrayAccountingOfficeClientCreateResult>
        <Status>1</Status>
        <AccountingOfficeClientCreateResult>
          <Id>70375</Id>
          <IdBiura>70369</IdBiura>
          <IdERP>1099624009</IdERP>
        </AccountingOfficeClientCreateResult>
      </ArrayAccountingOfficeClientCreateResult>
    </ACCOUNTINGOFFICECLIENTCREATEResponse>
  </soap:Body>
</soap:Envelope>
 
 
Obszar działania dealera, Produkty dealera, Klasyfikacje dealera – metoda DealerClassificationCreate
 
Komunikat:
 
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ass="http://www.assecobs.pl">
  <soapenv:Header />
  <soapenv:Body>
    <ass:DEALERCLASSIFICATIONCREATE>
      <ass:ArrayDealerClassificationCreateData>
        <!--1 or more repetitions:-->
        <ass:DealerClassificationCreateData>
          <ass:DealerId>24795</ass:DealerId>
          <ass:NIPSameCyfry>5860012643</ass:NIPSameCyfry>
          <!--Optional:-->
          <ass:Nazwa>Z.T.K. ANBUD-COMP s.c.</ass:Nazwa>
          <!--Optional:-->
          <ass:ArrayDealerClassificationParameters>
            <!--1 or more repetitions:-->
            <ass:DealerClassificationParameters>
              <ass:NazwaPola>Case study</ass:NazwaPola>
              <ass:WartoscPola />
            </ass:DealerClassificationParameters>
            <ass:DealerClassificationParameters>
              <ass:NazwaPola>Certfikaty WF-CRM</ass:NazwaPola>
              <ass:WartoscPola />
            </ass:DealerClassificationParameters>
            <ass:DealerClassificationParameters>
              <ass:NazwaPola>Certfikaty abStore</ass:NazwaPola>
              <ass:WartoscPola />
            </ass:DealerClassificationParameters>
            <ass:DealerClassificationParameters>
              <ass:NazwaPola>Certyfikaty</ass:NazwaPola>
              <ass:WartoscPola />
            </ass:DealerClassificationParameters>
            <ass:DealerClassificationParameters>
              <ass:NazwaPola>Certyfikaty WF-Analizy</ass:NazwaPola>
              <ass:WartoscPola />
            </ass:DealerClassificationParameters>
            <ass:DealerClassificationParameters>
              <ass:NazwaPola>Certyfikaty WF-FaKir</ass:NazwaPola>
              <ass:WartoscPola />
            </ass:DealerClassificationParameters>
            <ass:DealerClassificationParameters>
              <ass:NazwaPola>Certyfikaty WF-GANG</ass:NazwaPola>
              <ass:WartoscPola />
            </ass:DealerClassificationParameters>
            <ass:DealerClassificationParameters>
              <ass:NazwaPola>Certyfikaty WF-KaPeR</ass:NazwaPola>
              <ass:WartoscPola />
            </ass:DealerClassificationParameters>
            <ass:DealerClassificationParameters>
              <ass:NazwaPola>Certyfikaty WF-Mag</ass:NazwaPola>
              <ass:WartoscPola />
            </ass:DealerClassificationParameters>
            <ass:DealerClassificationParameters>
              <ass:NazwaPola>Certyfikaty WF-Mag Mobile 2</ass:NazwaPola>
              <ass:WartoscPola />
            </ass:DealerClassificationParameters>
            <ass:DealerClassificationParameters>
              <ass:NazwaPola>Certyfikaty WF-bEST</ass:NazwaPola>
              <ass:WartoscPola />
            </ass:DealerClassificationParameters>
            <ass:DealerClassificationParameters>
              <ass:NazwaPola>Kodp (rejestracja)</ass:NazwaPola>
              <ass:WartoscPola>84-241</ass:WartoscPola>
            </ass:DealerClassificationParameters>
            <ass:DealerClassificationParameters>
              <ass:NazwaPola>NIP</ass:NazwaPola>
              <ass:WartoscPola>586-001-26-43</ass:WartoscPola>
            </ass:DealerClassificationParameters>
            <ass:DealerClassificationParameters>
              <ass:NazwaPola>Nazwa firmy</ass:NazwaPola>
              <ass:WartoscPola>Z.T.K. ANBUD-COMP s.c.</ass:WartoscPola>
            </ass:DealerClassificationParameters>
            <ass:DealerClassificationParameters>
              <ass:NazwaPola>Produkt</ass:NazwaPola>
              <ass:WartoscPola>WF-FaKir</ass:WartoscPola>
            </ass:DealerClassificationParameters>
            <ass:DealerClassificationParameters>
              <ass:NazwaPola>Produkt</ass:NazwaPola>
              <ass:WartoscPola>WF-GANG</ass:WartoscPola>
            </ass:DealerClassificationParameters>
            <ass:DealerClassificationParameters>
              <ass:NazwaPola>Produkt</ass:NazwaPola>
              <ass:WartoscPola>WF-KaPeR</ass:WartoscPola>
            </ass:DealerClassificationParameters>
            <ass:DealerClassificationParameters>
              <ass:NazwaPola>Produkt</ass:NazwaPola>
              <ass:WartoscPola>WF-Mag</ass:WartoscPola>
            </ass:DealerClassificationParameters>
            <ass:DealerClassificationParameters>
              <ass:NazwaPola>Produkt</ass:NazwaPola>
              <ass:WartoscPola>WF-bEST</ass:WartoscPola>
            </ass:DealerClassificationParameters>
            <ass:DealerClassificationParameters>
              <ass:NazwaPola>Referencje</ass:NazwaPola>
              <ass:WartoscPola />
            </ass:DealerClassificationParameters>
            <ass:DealerClassificationParameters>
              <ass:NazwaPola>Szkolenia</ass:NazwaPola>
              <ass:WartoscPola />
            </ass:DealerClassificationParameters>
            <ass:DealerClassificationParameters>
              <ass:NazwaPola>Województwo</ass:NazwaPola>
              <ass:WartoscPola>pomorskie</ass:WartoscPola>
            </ass:DealerClassificationParameters>
            <ass:DealerClassificationParameters>
              <ass:NazwaPola>Zasięg</ass:NazwaPola>
              <ass:WartoscPola>pomorskie</ass:WartoscPola>
            </ass:DealerClassificationParameters>
          </ass:ArrayDealerClassificationParameters>
        </ass:DealerClassificationCreateData>
      </ass:ArrayDealerClassificationCreateData>
    </ass:DEALERCLASSIFICATIONCREATE>
  </soapenv:Body>
</soapenv:Envelope>
 
Odpowiedź:
 
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Header />
  <soap:Body>
    <DEALERCLASSIFICATIONCREATEResponse xmlns="http://www.assecobs.pl">
      <ArrayDealerClassificationCreateResult>
        <Status>1</Status>
        <DealerClassificationCreateResult>
          <DealerId>24795</DealerId>
          <NIPSameCyfry>5860012643</NIPSameCyfry>
          <Nazwa>Z.T.K. ANBUD-COMP s.c.</Nazwa>
        </DealerClassificationCreateResult>
      </ArrayDealerClassificationCreateResult>
    </DEALERCLASSIFICATIONCREATEResponse>
  </soap:Body>
</soap:Envelope>
 
Klienci hostingowi Wapro – metoda: HostingCustomerCreate
 
Komunikat:
 
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ass="http://www.assecobs.pl">
  <soapenv:Header />
  <soapenv:Body>
    <ass:HOSTINGCUSTOMERCREATE>
      <ass:ArrayHostingCustomerCreateData>
        <!--1 or more repetitions:-->
        <ass:HostingCustomerCreateData>
          <ass:Id>110731</ass:Id>
          <!--Optional:-->
          <ass:DataDodania>2015-12-10T00:00:00.000+02:00</ass:DataDodania>
          <!--Optional:-->
          <ass:KlientImie>Sławomir</ass:KlientImie>
          <!--Optional:-->
          <ass:KlientNazwisko>Wasylczyk</ass:KlientNazwisko>
          <!--Optional:-->
          <ass:KlientNazwaFirmy>Bezpol Secure Sp. z o.o.</ass:KlientNazwaFirmy>
          <!--Optional:-->
          <ass:KlientKodP>35-301</ass:KlientKodP>
          <!--Optional:-->
          <ass:KlientMiasto>Rzeszów</ass:KlientMiasto>
          <!--Optional:-->
          <ass:KlientUlica>Lwowska</ass:KlientUlica>
          <!--Optional:-->
          <ass:KlientNIP>5170371910</ass:KlientNIP>
          <!--Optional:-->
          <ass:KlientNipSameCyfry>5170371910</ass:KlientNipSameCyfry>
          <!--Optional:-->
          <ass:KlientTelefon>664604803</ass:KlientTelefon>
          <!--Optional:-->
          <ass:KlientEmail>bezpolsecure@bezpol.com</ass:KlientEmail>
          <!--Optional:-->
          <ass:KontaktImie>Albin</ass:KontaktImie>
          <!--Optional:-->
          <ass:KontaktNazwisko>Pięciak</ass:KontaktNazwisko>
          <!--Optional:-->
          <ass:KontaktTelefon>17 8578121</ass:KontaktTelefon>
          <!--Optional:-->
          <ass:KontaktEmail>albin.pieciak@bezpol.com</ass:KontaktEmail>
          <!--Optional:-->
          <ass:KontakUwagi xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:nil="true" />
          <!--Optional:-->
          <ass:ProgramOnline>N</ass:ProgramOnline>
          <!--Optional:-->
          <ass:ProgramMag>1</ass:ProgramMag>
          <!--Optional:-->
          <ass:ProgramMagBiznes>0</ass:ProgramMagBiznes>
          <!--Optional:-->
          <ass:ProgramAukcje>0</ass:ProgramAukcje>
          <!--Optional:-->
          <ass:ProgramFakir>1</ass:ProgramFakir>
          <!--Optional:-->
          <ass:ProgramKaper>0</ass:ProgramKaper>
          <!--Optional:-->
          <ass:ProgramGang>0</ass:ProgramGang>
          <!--Optional:-->
          <ass:ProgramBest>0</ass:ProgramBest>
          <!--Optional:-->
          <ass:ProgramAnalizy>0</ass:ProgramAnalizy>
          <!--Optional:-->
          <ass:ProgramMagMobileAndroid>0</ass:ProgramMagMobileAndroid>
          <!--Optional:-->
          <ass:ProgramMagMobileWindows>0</ass:ProgramMagMobileWindows>
          <!--Optional:-->
          <ass:ProgramMagMobilePDA>0</ass:ProgramMagMobilePDA>
          <!--Optional:-->
          <ass:ProgramJPK>0</ass:ProgramJPK>
          <!--Optional:-->
          <ass:PartnerNipSameCyfry xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:nil="true" />
          <!--Optional:-->
          <ass:PartnerEmail xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:nil="true" />
          <!--Optional:-->
          <ass:BiuroNipSameCyfry xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:nil="true" />
          <!--Optional:-->
          <ass:BiuroEmail xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:nil="true" />
          <!--Optional:-->
          <ass:ZgodaRegulamin>T</ass:ZgodaRegulamin>
          <!--Optional:-->
          <ass:ZgodaEFaktury>N</ass:ZgodaEFaktury>
          <!--Optional:-->
          <ass:ZgodaEmailEFaktury>bezpolsecure@bezpol.com</ass:ZgodaEmailEFaktury>
          <!--Optional:-->
          <ass:ZgodaInfHandlowe>T</ass:ZgodaInfHandlowe>
          <!--Optional:-->
          <ass:ZgodaEmail>N</ass:ZgodaEmail>
          <!--Optional:-->
          <ass:ZgodaSMS>N</ass:ZgodaSMS>
          <!--Optional:-->
          <ass:ZgodaKontaktKonsult>N</ass:ZgodaKontaktKonsult>
        </ass:HostingCustomerCreateData>
      </ass:ArrayHostingCustomerCreateData>
    </ass:HOSTINGCUSTOMERCREATE>
  </soapenv:Body>
</soapenv:Envelope>
 
Odpowiedź:
 
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Header />
  <soap:Body>
    <HOSTINGCUSTOMERCREATEResponse xmlns="http://www.assecobs.pl">
      <ArrayHostingCustomerCreateResult>
        <Status>1</Status>
        <HostingCustomerCreateResult>
          <Id>110731</Id>
          <IdERP>1101520044</IdERP>
        </HostingCustomerCreateResult>
      </ArrayHostingCustomerCreateResult>
    </HOSTINGCUSTOMERCREATEResponse>
  </soap:Body>
</soap:Envelope>