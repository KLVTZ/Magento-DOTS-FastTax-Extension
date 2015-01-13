Magento DOTS FastTax Extension
==============================
DOTS FastTax Extension for real-time sales tax from Service Objects API.

Requirements
------------
- REST Base URL: `http://ws.serviceobjects.com/rest/FT/api.svc/TaxInfoMulti/`
- License Key

Install
-------
1. Copy `app/code/community/DOTS` to `app/code/community`
2. Copy `app/etc/modules/DOTS_FastTax.xml` to `app/etc/modules`
3. Head on over to `System > Configuratiom > DOTS > DOTS FastTax Config`
4. Enter the required FastTax Credentials: REST Base URL and License Key
5. Select Taxable Regions. All regions selected will have tax applied through DOTS FastTax

Tree Structure
--------------
```bash
├── app
│   ├── code
│   │   └── community
│   │       └── DOTS
│   │           └── FastTax
│   │               ├── Helper
│   │               │   ├── DOTS.php
│   │               │   ├── Data.php
│   │               │   └── JSON.php
│   │               ├── Model
│   │               │   └── Calculation.php
│   │               └── etc
│   │                   ├── config.xml
│   │                   └── system.xml
│   └── etc
│       └── modules
│           └── DOTS_FastTax.xml
└── readme.md
```

QA
--
*Why do I have to enter my REST Base URL?* 

DOTS FastTax is subject to change
their HTTP GET. Because of this, leaving the base url open for configuration
allows both developers and non-developers to update when appropriate.

*Does this work outside the US and Canada?*

Unfortunately no. The API only
supports the United States and Canada. Although I provide the opportunity to
select regions outside the United States and Canada, only those two are
currently supported by [Service Objects](http://www.serviceobjects.com/).

Documentation
-------------
This plugin uses [DOTS FastTax REST API](https://docs.serviceobjects.com/display/rest/DOTS+FastTax+-+REST).
