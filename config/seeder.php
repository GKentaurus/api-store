<?php

return [
  /**
   * ANCHOR Constantes para los Database Seeders
   * $numberFactories => integer
   */
  'addressTable' => 50, // NOTE  min seedCompanyTable * 2
  'cartTable' => 4, //  NOTE min = seedUserTable
  'cardContentTable' => 50,
  'companyTable' => 10,  //  NOTE min = seedUserTable
  'documentTypeTable' => 4, // NOTE min = 4
  'orderTable'  => 4, // NOTE min <= seedCartTable
  'orderStatusTable' => 10,  // NOTE min = 7
  'paymentMethodTable' => 10, // NOTE min = 4
  'priceListTable' => 4, // NOTE min = 4
  'priceTable' => 4, // NOTE min = 4
  'productTable' => 5, // NOTE min = 5
  'productCategoryTable' => 10, // NOTE min = 1
  'userCategoryTable' => 4, // NOTE min = 4
  'userTable' => 4, // NOTE min = 4
];
