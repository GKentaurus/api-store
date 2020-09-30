<?php

return [
  /**
   * ANCHOR Constantes para los Database Seeders
   * $numberFactories => integer
   */
  'seedAddressTable' => 50, // NOTE  min seedCompanyTable * 2
  'seedCartTable' => 4, //  NOTE min = seedUserTable
  'seedCardContentTable' => 50,
  'seedCompanyTable' => 20,  //  NOTE min = seedUserTable
  'seedDocumentTypeTable' => 4, // NOTE min = 4
  'seedOrderTable'  => 4, // NOTE min <= seedCartTable
  'seedOrderStatusTable' => 10,  // NOTE min = 7
  'seedPaymentMethodTable' => 10, // NOTE min = 4
  'seedPriceListTable' => 4, // NOTE min = 4
  'seedPriceTable' => 5, // NOTE min = 5
  'seedProductTable' => 5, // NOTE min = 5
  'seedProductCategoryTable' => 10, // NOTE min = 1
  'seedUserCategoryTable' => 4, // NOTE min = 4
  'seedUserTable' => 4, // NOTE min = 4
];
