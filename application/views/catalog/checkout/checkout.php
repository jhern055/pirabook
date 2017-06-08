<style type="text/css">
@charset "UTF-8";
/*
  Journal - Advanced Opencart Theme Framework
  Version 2.6.7
  Copyright (c) 2016 Digital Atelier
  http://journal.digital-atelier.com/
*/
/******************************
RESET
*******************************/
html, body, div, span, object, iframe, h1, h2, h3, h4, h5, h6, p, a, img, small, strong, b, i, dl, dt, dd, form, label, footer, header, menu, nav, section {
  margin: 0;
  padding: 0;
  border: 0;
  outline: 0; }

body {
  overflow-x: hidden; }

article, aside, details, figcaption, figure, footer, header, menu, nav, section {
  display: block; }

textarea:focus, input:focus, select:focus, button:focus {
  outline: none; }

header *, #container *, footer *, #top-modules *, #bottom-modules * {
  box-sizing: border-box; }

* {
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  -webkit-tap-highlight-color: transparent; }

.clearfix {
  clear: both;
  display: block; }

:before, :after {
  font-family: 'journal-icons';
  position: relative;
  font-style: normal;
  font-variant: normal;
  font-weight: normal;
  color: inherit;
  font-size: inherit;
  display: inline-block;
  -moz-osx-font-smoothing: grayscale;
  -webkit-font-smoothing: antialiased; }

i {
  position: relative;
  font-style: normal;
  vertical-align: middle; }
  i img {
    position: relative;
    vertical-align: middle; }

/******************************
JOURNAL GRID
*******************************/
.xl-5 {
  width: 5%; }

.xl-10 {
  width: 10%; }

.xl-15 {
  width: 15%; }

.xl-20 {
  width: 20%; }

.xl-25 {
  width: 25%; }

.xl-30 {
  width: 30%; }

.xl-35 {
  width: 35%; }

.xl-40 {
  width: 40%; }

.xl-45 {
  width: 45%; }

.xl-50 {
  width: 50%; }

.xl-55 {
  width: 55%; }

.xl-60 {
  width: 60%; }

.xl-65 {
  width: 65%; }

.xl-70 {
  width: 70%; }

.xl-75 {
  width: 75%; }

.xl-80 {
  width: 80%; }

.xl-85 {
  width: 85%; }

.xl-90 {
  width: 90%; }

.xl-95 {
  width: 95%; }

.xl-100 {
  width: 100%; }

.xl-11 {
  width: 11.11111111111111%; }

.xl-12 {
  width: 12.5%; }

.xl-14 {
  width: 14.28571428571429%; }

.xl-16 {
  width: 16.66666666666666%; }

.xl-33 {
  width: 33.33333333333333%; }

.xl-66 {
  width: 66.66666666666666%; }

.xs-5, .xs-10, .xs-15, .xs-20, .xs-25, .xs-30, .xs-35, .xs-40, .xs-45, .xs-50, .xs-55, .xs-60, .xs-65, .xs-70, .xs-75, .xs-80, .xs-85, .xs-90, .xs-95, .xs-100, .xs-33, .xs-66, .sm-5, .sm-10, .sm-15, .sm-20, .sm-25, .sm-30, .sm-35, .sm-40, .sm-45, .sm-50, .sm-55, .sm-60, .sm-65, .sm-70, .sm-75, .sm-80, .sm-85, .sm-90, .sm-95, .sm-100, .sm-33, .sm-66, .md-5, .md-10, .md-15, .md-20, .md-25, .md-30, .md-35, .md-40, .md-45, .md-50, .md-55, .md-60, .md-65, .md-70, .md-75, .md-80, .md-85, .md-90, .md-95, .md-100, .md-33, .md-66, .lg-5, .lg-10, .lg-15, .lg-20, .lg-25, .lg-30, .lg-35, .lg-40, .lg-45, .lg-50, .lg-55, .lg-60, .lg-65, .lg-70, .lg-75, .lg-80, .lg-85, .lg-90, .lg-95, .lg-100, .lg-33, .lg-66, .xl-5, .xl-10, .xl-15, .xl-20, .xl-25, .xl-30, .xl-35, .xl-40, .xl-45, .xl-50, .xl-55, .xl-60, .xl-65, .xl-70, .xl-75, .xl-80, .xl-85, .xl-90, .xl-95, .xl-100, .xl-33, .xl-66 {
  min-height: 1px;
  float: left; }

.xs-11, .xs-12, .xs-14, .xs-16,
.sm-11, .sm-12, .sm-14, .sm-16,
.md-11, .md-12, .md-14, .md-16,
.lg-11, .lg-12, .lg-14, .lg-16,
.xl-11, .xl-12, .xl-14, .xl-16 {
  min-height: 1px;
  float: left; }

/******************************
 GENERAL STRUCTURE
*******************************/
.j-min {
  height: 40px; }

.j-med {
  height: 80px; }

.j-tall {
  height: 120px; }

.j-50 {
  height: 50px; }

.j-100 {
  height: 100px; }

.z-0 {
  z-index: 0; }

.z-1 {
  z-index: 1; }

.z-2 {
  z-index: 2; }

.z-3 {
  z-index: 3; }

.z-4 {
  z-index: 4; }

.z-5 {
  z-index: 5; }

.z-6 {
  z-index: 6; }

.z-7 {
  z-index: 7; }

.z-8 {
  z-index: 8; }

.z-9 {
  z-index: 9; }

body {
  font-size: 13px;
  font-family: Helvetica, Arial, sans-serif; }

/******************************
 CONTENT
*******************************/
#container {
  max-width: 1024px;
  position: relative;
  margin: 0 auto;
  background-color: transparent;
  z-index: 3; }

.heading-title, .box-heading {
  line-height: 37px;
  height: 40px;
  font-size: 15px;
  font-weight: normal;
  text-transform: uppercase;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis; }

.heading-title {
  margin-bottom: 17px; }

.secondary-title {
  font-family: Helvetica, Arial, sans-serif;
  font-size: 17px;
  color: #5C8BA6; }

#content {
  position: relative;
  z-index: 2;
  padding: 20px 20px 0 20px;
  background-color: transparent;
  -webkit-transform: translate3d(0, 0, 0); }
  #content:after {
    content: ".";
    display: block;
    clear: both;
    height: 0;
    visibility: hidden; }

.box {
  position: relative; }

#content .content ul, #content .content li {
  margin: 0;
  padding: 0;
  list-style: none;
  position: relative; }
#content .content ul {
  margin: 8px 0; }
#content .content > ul > li > a {
  display: inline-block;
  padding: 4px 0 4px 10px;
  font-size: inherit; }

/******************************
 BUTTONS / LINKS
*******************************/
a {
  color: #333745;
  text-decoration: none;
  cursor: pointer; }

button {
  border: none;
  background-color: transparent;
  padding: 0; }

.button {
  cursor: pointer;
  font-size: 14px;
  transition: color .2s, background-color .2s;
  padding: 0 12px;
  border: 0;
  line-height: 32px;
  background-color: transparent;
  display: inline-block;
  -webkit-appearance: none;
  text-align: center; }
  .button i:before {
    padding: 0 1px; }

.cart {
  position: relative; }

.button-disabled {
  opacity: .5;
  cursor: default; }
  .button-disabled:before, .button-disabled:after {
    display: none !important; }

.buttons {
  overflow: hidden;
  padding: 15px 0;
  line-height: 30px;
  margin: 20px 0 20px 0; }
  .buttons .left {
    padding-top: 2px; }

.buttons .left {
  float: left;
  text-align: left; }

.buttons .right {
  float: right;
  text-align: right; }

.buttons .right a {
  text-decoration: none !important; }

.buttons .center {
  float: left;
  text-align: center;
  margin-left: auto;
  margin-right: auto; }

hr {
  border: 0;
  background-color: #E4E4E4;
  height: 1px;
  margin: 0; }

/******************************
 BREADCRUMB
*******************************/
.breadcrumb {
  margin: 0 auto;
  padding: 0 15px;
  height: 40px;
  line-height: 38px;
  position: relative;
  z-index: 1;
  white-space: nowrap;
  overflow: hidden;
  -o-text-overflow: ellipsis;
  text-overflow: ellipsis;
  border: 0; }
  .breadcrumb a {
    color: inherit;
    font-size: inherit;
    transition: all .2s ease;
    display: inline-block;
    vertical-align: middle; }

ul.breadcrumb {
  list-style: none; }
  ul.breadcrumb li {
    display: inline-block; }
    ul.breadcrumb li a {
      margin: 0 4px; }
    ul.breadcrumb li:before {
      content: "»"; }
    ul.breadcrumb li:first-of-type a {
      margin-left: 0; }
    ul.breadcrumb li:first-of-type:before {
      display: none; }

.extended-container {
  position: relative;
  z-index: 10; }
  .extended-container:before {
    content: "";
    display: block;
    width: 100%;
    height: 40px;
    position: absolute; }

.home-page .extended-container:before,
.maintenance-mode .extended-container:before {
  display: none; }

.home-page #container:before {
  content: "";
  display: block;
  position: absolute;
  left: 50%;
  top: 0; }

.maintenance-message {
  padding-bottom: 20px;
  padding-top: 20px; }
  .maintenance-message h1 {
    line-height: 30px; }
    .maintenance-message h1 br {
      display: none; }

/******************************
 NOTIFICATION
*******************************/
.journal-slider + #container > #notification {
  display: none; }

#notification {
  position: absolute;
  z-index: 2;
  width: 100%; }

.success, .warning, .information, .attention {
  width: 100%;
  position: relative;
  z-index: 2;
  height: auto;
  padding: 10px 15px;
  line-height: 20px; }
  .success a, .warning a, .information a, .attention a {
    color: #428bca; }
  .success img, .warning img, .information img, .attention img {
    float: right;
    margin-top: 6px;
    cursor: pointer;
    display: block; }

.success {
  background-color: #CDECA6; }

.warning {
  background-color: #FBE3A7; }

.attention {
  background-color: #FBE3A7; }

.information {
  background-color: #BFE7F1; }

.fa-exclamation-circle {
  font-size: 17px; }

/******************************
 INPUTS
*******************************/
.required, .cart-info .stock {
  color: #EA2E49;
  font-size: 16px; }

input[type='text'],
input[type='email'],
input[type='password'],
input[type='tel'],
textarea {
  -webkit-appearance: none;
  background: white;
  border-radius: 0px;
  border: 1px solid #E4E4E4;
  padding: 8px;
  width: 100%;
  transition: all 0.2s;
  font-size: 13px;
  box-shadow: inset 0 0px 3px rgba(0, 0, 0, 0.08); }

textarea {
  width: 100%;
  max-width: 100%;
  resize: none;
  height: 150px; }

input[type='radio'],
input[type='checkbox'] {
  margin: 5px; }

select {
  background: #f4f4f4;
  border: 1px solid #E4E4E4;
  padding: 5px;
  margin: 5px;
  max-width: 100%; }

label {
  cursor: pointer;
  padding-right: 20px; }

span.error,
.text-danger {
  display: inline-block;
  background-color: #EA2E49;
  color: white;
  padding: 3px 4px 2px 4px;
  font-size: 12px;
  position: relative; }

/******************************
 COLORBOX
*******************************/
#cboxLoadedContent h1 {
  padding-bottom: 2px;
  display: inline-block;
  border-bottom: 1px solid #E4E4E4;
  margin: 10px 0 10px 10px;
  font-size: 24px; }
#cboxLoadedContent p {
  padding: 0 10px; }

/******************************
 RESPONSIVE VIDEO
*******************************/
.responsive-video {
  position: relative;
  padding-bottom: 56.25%;
  padding-top: 30px;
  height: 0;
  overflow: hidden; }
  .responsive-video > iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%; }

.extended-layout #column-left {
  padding: 20px 0 0 0;
  width: 220px; }
.extended-layout #column-right {
  padding: 20px 0 0 0;
  width: 220px; }
.extended-layout #column-left + #content {
  padding: 20px 0 0 20px;
  margin-left: 220px; }
.extended-layout #column-right + #content {
  padding: 20px 20px 0 0;
  margin-right: 220px; }
.extended-layout #column-left + #column-right + #content {
  padding: 20px 20px 0 20px;
  margin-left: 220px;
  margin-right: 220px; }
.extended-layout #content {
  padding: 20px 0 0 0; }

/******************************
 TOP BOTTOM POSITION
*******************************/
#top-modules, #bottom-modules {
  z-index: 1; }
  #top-modules > div, #bottom-modules > div {
    margin: 0 auto;
    overflow: hidden;
    z-index: 1; }
    #top-modules > div.journal2_slider, #top-modules > div.gutter, #bottom-modules > div.journal2_slider, #bottom-modules > div.gutter {
      padding: 0; }
    #top-modules > div > div, #bottom-modules > div > div {
      position: relative;
      margin: 0 auto; }
  #top-modules .box.static-banners,
  #top-modules .multi-modules-wrapper,
  #top-modules .box.journal-carousel
  .box.custom-sections,
  #top-modules .box.cms-blocks, #bottom-modules .box.static-banners,
  #bottom-modules .multi-modules-wrapper,
  #bottom-modules .box.journal-carousel
  .box.custom-sections,
  #bottom-modules .box.cms-blocks {
    padding-bottom: 0 !important; }
  #top-modules .multi-modules-wrapper, #bottom-modules .multi-modules-wrapper {
    margin-bottom: -20px; }

#top-modules {
  position: relative; }

.ui-menu {
  z-index: 99 !important; }

/******************************
OC 2
*******************************/
.oc2 .extended-layout #column-left + .row #content {
  padding: 20px 0 0 20px;
  margin-left: 220px; }
.oc2 .extended-layout #column-right + .row #content {
  padding: 20px 20px 0 0;
  margin-right: 220px; }
.oc2 .extended-layout #column-left + #column-right + .row #content {
  padding: 20px 20px 0 20px;
  margin-left: 220px;
  margin-right: 220px; }
.oc2.information-page #content {
  padding-bottom: 20px; }
.oc2 .required {
  color: inherit; }
  .oc2 .required label {
    font-weight: normal; }
    .oc2 .required label:before {
      content: "* ";
      color: red;
      font-weight: bold;
      font-size: 16px;
      position: relative;
      top: 3px;
      margin-right: 3px; }
.oc2 fieldset {
  border: none;
  padding: 0;
  margin: 0; }
  .oc2 fieldset > div {
    clear: both;
    margin-bottom: 6px;
    overflow: hidden; }
  .oc2 fieldset .radio {
    padding-top: 7px; }
    .oc2 fieldset .radio label {
      width: 100%;
      padding-top: 0; }
      .oc2 fieldset .radio label:before {
        display: none; }
  .oc2 fieldset label {
    width: 25%;
    float: left;
    display: block;
    padding-top: 7px; }
  .oc2 fieldset label + div, .oc2 fieldset label + input.form-control {
    width: 75%;
    float: right; }
  .oc2 fieldset .radio-inline {
    width: auto; }
    .oc2 fieldset .radio-inline:before {
      display: none; }
.oc2 .form-horizontal .form-group {
  overflow: hidden;
  margin-bottom: 5px; }
  .oc2 .form-horizontal .form-group label {
    width: 25%;
    float: left;
    display: block;
    padding-top: 7px; }
  .oc2 .form-horizontal .form-group label + div {
    width: 75%;
    float: right; }
.oc2 .secondary-title {
  margin-bottom: 10px; }
.oc2 .input-group {
  display: table;
  position: relative; }
  .oc2 .input-group .form-control {
    float: left;
    display: table-cell; }
.oc2 .input-group-btn {
  font-size: 14px;
  display: table-cell;
  vertical-align: middle; }
  .oc2 .input-group-btn button {
    padding: 6px 12px 9px 12px;
    cursor: pointer;
    font-size: 12px;
    box-shadow: none; }
    .oc2 .input-group-btn button:hover {
      transition: all 0.2s; }
.oc2 .date .input-group-btn button, .oc2 .time .input-group-btn button, .oc2 .datetime .input-group-btn button {
  border-top-left-radius: 0;
  border-bottom-left-radius: 0; }
.oc2 .fa {
  font-size: 14px; }
  .oc2 .fa:before {
    font-family: 'FontAwesome'; }
.oc2 .captcha-row .pull-right {
  float: none;
  margin-left: 25%; }
.oc2 .alert button {
  font-size: 15px;
  position: absolute;
  right: 10px;
  cursor: pointer; }

.oc2.firefox .input-group-btn {
  display: inline-block; }

.oc2.route-account-register .form-horizontal .radio {
  padding-top: 0; }
  .oc2.route-account-register .form-horizontal .radio label {
    width: auto;
    float: none;
    padding-top: 0; }
.oc2.route-account-register .form-horizontal label.radio-inline {
  width: auto; }

.modal {
  color: #222; }

.old-browser {
  display: table;
  width: 100%;
  text-align: center;
  font-size: 16px;
  color: #ffffff;
  background-color: #f74558;
  height: 60px;
  line-height: 60px;
  position: fixed;
  z-index: 9999999;
  top: 0; }
  .old-browser a {
    text-decoration: underline;
    color: #fff; }

.oc1 .ui-datepicker {
  z-index: 99999999 !important; }

.i6 body, .ie7 body, .ie8 body {
  padding-top: 60px; }

.tooltip + .tooltip {
  visibility: visible; }

.android:not(.chrome) .product-grid-item .name a {
  display: block; }
/*
  Journal - Advanced Opencart Theme Framework
  Version 2.6.7
  Copyright (c) 2016 Digital Atelier
  http://journal.digital-atelier.com/
*/
/******************************
 SHOPPING CART
*******************************/
.cart-info .stock {
  color: red; }
.cart-info .name {
  max-width: 400px;
  text-align: left; }
  .cart-info .name a {
    font-weight: bold; }
.cart-info .image {
  text-align: center;
  max-width: 100px; }
  .cart-info .image img {
    margin: 5px 0;
    float: left;
    margin-left: 10px; }
.cart-info .quantity {
  min-width: 110px;
  text-align: center; }
  .cart-info .quantity .input-group {
    display: inline-block; }
    .cart-info .quantity .input-group input {
      margin-right: 5px;
      border-radius: 4px; }
    .cart-info .quantity .input-group .btn-primary {
      background-color: #428bca; }
      .cart-info .quantity .input-group .btn-primary:hover {
        background-color: #3071a9; }
    .cart-info .quantity .input-group .btn-danger {
      background-color: #EA2E49; }
      .cart-info .quantity .input-group .btn-danger:hover {
        background-color: #d01530; }
.cart-info .price, .cart-info .total {
  font-weight: bold; }
.cart-info table {
  overflow: hidden; }
.cart-info td {
  padding: 5px 10px 5px 5px;
  text-align: center; }
.cart-info thead td {
  height: 40px;
  font-weight: bold;
  border-bottom: none;
  font-size: 13px; }
.cart-info tbody td {
  border-bottom-style: solid;
  border-bottom-width: 1px;
  border-bottom-color: #E4E4E4; }
.cart-info tbody td.image {
  padding-left: 0; }
.cart-info tbody tr:last-of-type td {
  border-bottom: none; }

#content.sc-page .content p, #content.sc-page .action-area p {
  padding: 10px;
  font-size: 13px; }
#content.sc-page .content table.radio .highlight td {
  border-bottom: 1px solid;
  border-color: #f4f4f4; }
#content.sc-page .content table.radio .highlight:last-of-type td {
  border-bottom: none; }
#content.sc-page a + .text-danger {
  color: #EA2E49;
  background-color: transparent; }

.cart-module > div {
  display: none; }
  .cart-module > div form {
    padding-left: 10px; }
    .cart-module > div form input[type='text'] {
      max-width: 240px;
      margin: 20px 0; }
  .cart-module > div input[name='postcode'] {
    width: 100px;
    margin-left: 6px;
    margin-top: 5px; }

#shipping table {
  padding: 10px 0;
  width: 45%; }
  #shipping table td:first-of-type {
    font-weight: bold; }
#shipping select {
  width: 150px; }
#shipping .button {
  margin: 10px 0; }

.cart-total {
  overflow: auto;
  padding: 8px; }
  .cart-total table {
    float: right; }
  .cart-total td {
    padding: 4px;
    text-align: right; }

label {
  line-height: 1.5;
  font-size: 13px;
  position: relative; }

#total .right {
  font-size: 14px;
  width: 87%;
  font-weight: bold; }

.quantity input[type='text'] {
  width: 40px;
  text-align: center; }

.action-area {
  overflow: hidden; }
  .action-area h3 {
    padding: 10px 12px; }

.oc2 .action-area .panel-heading {
  padding: 0; }
  .oc2 .action-area .panel-heading .panel-title > a {
    padding: 10px;
    display: block; }
.oc2 .action-area .panel-group {
  margin-bottom: 0; }
.oc2 .action-area .panel-body label {
  display: inline-block;
  margin-bottom: 5px; }
.oc2 .action-area .panel-body .input-group input[type="text"] {
  min-width: 300px; }
.oc2 .action-area .panel-body .input-group .button {
  margin-left: 5px; }
.oc2 .action-area .form-group {
  clear: both;
  margin-top: 10px; }
  .oc2 .action-area .form-group label {
    min-width: 150px;
    float: left;
    margin-bottom: 0; }
  .oc2 .action-area .form-group input[type="text"] {
    max-width: 160px; }
.oc2 .checkout #accordion {
  overflow: hidden; }
.oc2 .checkout-content {
  background-color: transparent;
  padding: 0;
  display: block; }
  .oc2 .checkout-content .right .form-group {
    margin-bottom: 8px; }
  .oc2 .checkout-content p, .oc2 .checkout-content .radio {
    padding: 10px 0 0 0; }

.order-list .list td {
  text-align: center; }

.sc-page .buttons .pull-left {
  margin-bottom: 10px; }

/******************************
 CHECKOUT PAGE
*******************************/
.checkout {
  margin-bottom: 20px;
  overflow: hidden; }
  .checkout select {
    margin: 0 0 3px 0; }
  .checkout div:last-of-type .checkout-heading {
    border-bottom: none; }

.checkout-heading {
  border-bottom: 1px solid;
  border-color: #333745;
  font-size: 13px;
  min-height: 35px;
  padding: 10px;
  clear: both; }

.checkout-heading a {
  float: right;
  margin-top: 1px;
  font-weight: normal;
  text-decoration: none; }

.checkout-content {
  padding: 0 0 15px 0;
  display: none;
  position: relative; }
  .checkout-content:after {
    content: "";
    display: table;
    clear: both; }
  .checkout-content table.radio td:first-child {
    width: 25px; }
  .checkout-content p {
    padding: 10px 0; }
  .checkout-content .left {
    float: left;
    width: 48%; }
  .checkout-content .right {
    float: right;
    width: 48%; }
  .checkout-content .left p:last-of-type {
    min-height: 92px; }
  .checkout-content .buttons {
    margin-bottom: 0;
    clear: both; }
    .checkout-content .buttons .right {
      width: 100%; }
  .checkout-content textarea {
    width: 100% !important;
    margin-top: 15px; }

#payment-address h2 {
  margin-bottom: 15px; }

.checkout-product .total {
  font-weight: bold; }
.checkout-product td {
  padding: 15px; }
.checkout-product thead td {
  font-weight: bold;
  padding: 13px; }
.checkout-product .name,
.checkout-product .model {
  text-align: left; }
.checkout-product .quantity,
.checkout-product .price,
.checkout-product .total {
  text-align: right; }
.checkout-product tbody td {
  border-bottom: 1px solid;
  border-color: #f4f4f4; }
.checkout-product tfoot td {
  text-align: right;
  padding: 6px 15px; }

.wait {
  position: absolute;
  padding-top: 12px;
  right: -10px;
  bottom: 30px; }

.newsletter-page table.form {
  padding-top: 0; }

.oc2 .oc-newsletter .form-horizontal .form-group > label {
  width: auto;
  padding-top: 10px; }
.oc2 .oc-newsletter .form-horizontal .form-group .radio-inline {
  width: auto; }
.oc2 .oc-newsletter .form-horizontal .form-group label + div {
  float: none;
  padding-top: 0; }

/******************************
 RETURNS
*******************************/
.returns > h1 + p {
  margin-bottom: 15px; }
.returns form h2, .returns form .content {
  margin-bottom: 15px; }
.returns .left {
  float: none; }
.returns .buttons .left {
  float: left; }

@media only screen and (max-width: 980px) {
  .return-product > div {
    width: 100%;
    display: block; }
    .return-product > div input {
      margin: 3px 0; }

  .return-detail > div {
    width: 100%;
    display: block; }

  .return-reason {
    margin-bottom: 20px; } }
/******************************
 SITEMAP
*******************************/
.sitemap-info {
  overflow: auto;
  padding-bottom: 20px; }
  .sitemap-info ul {
    margin: 0;
    padding: 0; }
    .sitemap-info ul li {
      list-style: none;
      padding: 2px;
      margin-bottom: 1px;
      font-weight: bold; }
  .sitemap-info > div {
    float: left;
    width: 50%;
    padding-left: 7px; }
    .sitemap-info > div > ul {
      padding: 10px 0 5px 15px; }
    .sitemap-info > div > ul > li ul {
      margin-left: 7px; }
      .sitemap-info > div > ul > li ul > li a {
        font-weight: normal; }
    .sitemap-info > div > ul > li > ul li:before {
      font-size: 12px; }
  .sitemap-info > div:first-of-type {
    padding-left: 0;
    padding-right: 10px; }

/******************************
BRANDS
*******************************/
.header-default-sticky .manufacturer-list a[id]:before, .header-slim-sticky .manufacturer-list a[id]:before {
  content: "";
  display: block;
  height: 120px;
  margin-top: -120px; }

.header-center-sticky .manufacturer-list a[id]:before {
  content: "";
  display: block;
  height: 150px;
  margin-top: -150px; }

.manufacturer-list:first-of-type {
  margin-top: 10px; }

.manufacturer-list {
  overflow: auto; }
  .manufacturer-list ul {
    float: left;
    width: 25%;
    margin: 0;
    padding: 0;
    list-style: none;
    margin-bottom: 10px; }

.manufacturer-heading {
  background: #5F6874;
  font-size: 15px;
  font-weight: bold;
  padding: 5px 8px;
  margin-bottom: 6px; }

.manufacturer-content {
  padding: 8px; }

.manufacturer-list ul {
  float: left;
  width: 25%;
  margin: 0;
  padding: 0;
  list-style: none;
  margin-bottom: 10px; }

/******************************
 CONTACT PAGE
*******************************/
.contact-page h2 {
  margin-bottom: 15px; }
.contact-page .buttons {
  margin-top: 15px; }
.contact-page .content b {
  margin-bottom: 5px;
  display: inline-block; }

.contact-info {
  overflow: auto; }

.contact-info > div > div {
  float: left;
  width: 48%;
  margin-bottom: 10px; }

.oc2 .contact-page h2 {
  margin-bottom: 15px; }
.oc2 .contact-page .fa {
  top: -1px;
  font-size: 16px; }
.oc2 .contact-page .col {
  float: left;
  width: 25%;
  padding-left: 15px; }
  .oc2 .contact-page .col strong {
    display: inline-block;
    margin-bottom: 5px; }
  .oc2 .contact-page .col:first-of-type {
    padding-left: 0; }
.oc2 .contact-page .col-sm-10 {
  width: 75%;
  margin-bottom: 5px; }
.oc2 .contact-page input[name='captcha'] {
  margin: 0; }
.oc2 .contact-page .panel-body {
  margin-bottom: 20px;
  overflow: hidden;
  background-color: transparent; }
.oc2 .img-thumbnail {
  max-width: 100%;
  height: auto; }
.oc2 address {
  margin-bottom: 20px; }

.route-account-return-add fieldset .radio label,
.route-account-return-add fieldset .radio-inline {
  width: 100% !important; }

/******************************
 SEARCH PAGE
*******************************/
#content.search-page .buttons + h2 {
  margin-bottom: 15px; }
#content.search-page .content {
  margin: 15px 0;
  padding-bottom: 5px;
  overflow: hidden; }
  #content.search-page .content input[type="text"] {
    width: 265px; }
  #content.search-page .content input[type='checkbox'] {
    position: relative;
    top: 2px; }
  #content.search-page .content select {
    margin: 10px; }
  #content.search-page .content > div {
    float: left;
    position: relative; }
  #content.search-page .content .s-check {
    top: 7px; }

.oc2 #content.search-page {
  padding-bottom: 20px; }

.oc2.firefox #content.search-page .content select,
.oc2.win #content.search-page .content select {
  margin-top: 2px; }
.oc2.firefox #content.search-page .content input[type='checkbox'],
.oc2.win #content.search-page .content input[type='checkbox'] {
  position: relative;
  top: 2px; }

/******************************
 COMPARE
*******************************/
.compare-info img {
  max-width: 100% !important; }

/******************************
QUICK CHECKOUT
*******************************/
.one-page-checkout .heading-title {
  overflow: visible;
  white-space: normal;
  height: auto; }

.checkout-loading {
  opacity: 0.5;
  pointer-events: none; }

.journal-checkout {
  display: table;
  width: 100%;
  margin-bottom: 20px; }
  .journal-checkout .secondary-title {
    margin-bottom: 15px; }
  .journal-checkout .checkout-content {
    background: #f4f4f4;
    padding: 12px;
    display: block; }
    .journal-checkout .checkout-content .buttons {
      margin-top: 0; }
    .journal-checkout .checkout-content.checkout-login {
      display: none;
      margin-bottom: 18px; }
  .journal-checkout .login-box {
    margin-bottom: 18px;
    display: table;
    width: 100%; }
    .journal-checkout .login-box .radio {
      padding-top: 3px; }
  .journal-checkout .checkout-login .form-group {
    position: relative;
    overflow: visible !important;
    display: table;
    width: 100%; }
    .journal-checkout .checkout-login .form-group input + a {
      margin-top: 5px; }
    .journal-checkout .checkout-login .form-group:last-of-type {
      border-top-width: 1px;
      border-top-style: solid;
      border-color: #f4f4f4;
      margin-top: 12px;
      padding-top: 12px; }
  .journal-checkout .checkout-login .button {
    line-height: 34px; }
  .journal-checkout .left, .journal-checkout .right {
    width: 64%;
    float: left; }
  .journal-checkout .left {
    width: 36%;
    padding-right: 18px; }
    .journal-checkout .left .checkout-content span.error, .journal-checkout .left .checkout-content .text-danger {
      width: 100%; }
    .journal-checkout .left .checkout-content label {
      display: block;
      width: 100%;
      padding: 0 0 0 1px;
      line-height: 100%;
      margin-bottom: 3px; }
    .journal-checkout .left .checkout-content label + input,
    .journal-checkout .left .checkout-content label + div {
      width: 100%;
      float: none; }
    .journal-checkout .left #password {
      margin: 7px 0; }
    .journal-checkout .left .login-box .secondary-title {
      margin-bottom: 5px; }
    .journal-checkout .left .login-box .radio label {
      padding-bottom: 7px;
      border-bottom-width: 1px;
      border-bottom-style: solid;
      border-color: #f4f4f4; }
    .journal-checkout .left .login-box .radio:last-of-type label {
      border-bottom: 0;
      margin-bottom: 0;
      padding-bottom: 0; }
  .journal-checkout .right .checkout-content {
    margin-bottom: 18px; }
  .journal-checkout .right .confirm-section {
    margin-bottom: 0; }
  .journal-checkout .spw {
    margin-bottom: 18px;
    display: table;
    width: 100%; }
    .journal-checkout .spw > div {
      display: table-cell;
      min-width: 50%; }
      .journal-checkout .spw > div .radio {
        padding: 3px 0 0 0;
        margin-bottom: 2px; }
        .journal-checkout .spw > div .radio label {
          padding-bottom: 6px;
          border-bottom: 1px;
          border-bottom-style: solid;
          border-color: #f4f4f4;
          display: block; }
        .journal-checkout .spw > div .radio:last-of-type label {
          border-bottom: 0;
          margin-bottom: 0;
          padding-bottom: 0; }
      .journal-checkout .spw > div .secondary-title {
        margin-bottom: 5px; }
      .journal-checkout .spw > div p {
        padding-top: 5px;
        margin-bottom: 0px; }
  .journal-checkout .confirm-order {
    border-top: 1px;
    border-top-style: solid;
    border-color: #f4f4f4;
    margin-top: 12px;
    padding-top: 12px; }
  .journal-checkout .confirm-section .secondary-title {
    margin-bottom: 0; }
  .journal-checkout .confirm-section textarea {
    margin-top: 10px; }
  .journal-checkout .confirm-section .radio {
    padding-top: 4px; }
  .journal-checkout .confirm-button {
    line-height: 34px; }
  .journal-checkout #payment-confirm-button .secondary-title {
    margin-top: 15px; }
  .journal-checkout #payment-confirm-button .buttons {
    display: none !important;
    cursor: not-allowed !important; }
    .journal-checkout #payment-confirm-button .buttons .btn {
      pointer-events: none !important; }
  .journal-checkout #payment-confirm-button fieldset legend {
    font-size: 14px;
    font-weight: bold;
    border-left-width: 0;
    border-right-width: 0;
    border-top-width: 0;
    border-bottom-width: 1px;
    border-bottom-style: solid;
    border-color: #f4f4f4;
    width: 100%;
    margin-bottom: 12px;
    padding-bottom: 8px;
    padding-left: 0; }
  .journal-checkout #payment-confirm-button fieldset input[type='text'],
  .journal-checkout #payment-confirm-button fieldset input[type='email'],
  .journal-checkout #payment-confirm-button fieldset input[type='password'] {
    max-width: 280px; }
  .journal-checkout #payment-confirm-button fieldset #card-new label {
    width: 30%;
    line-height: 1.1;
    min-height: 40px; }
  .journal-checkout #payment-confirm-button fieldset #card-new label + div {
    width: 70%; }
  .journal-checkout .checkout-cart td {
    border-left-width: 0;
    border-right-width: 0;
    border-top-width: 0;
    border-bottom-width: 0; }
  .journal-checkout .checkout-cart thead td {
    text-align: center;
    border-top-width: 1px;
    border-style: solid;
    border-color: #f4f4f4;
    font-weight: normal; }
    .journal-checkout .checkout-cart thead td:first-of-type {
      border-left-width: 1px;
      border-style: solid;
      border-color: #f4f4f4; }
    .journal-checkout .checkout-cart thead td:last-of-type {
      border-right-width: 1px;
      border-style: solid;
      border-color: #f4f4f4; }
  .journal-checkout .checkout-cart tbody tr:first-of-type td {
    border-style: solid;
    border-color: #f4f4f4;
    border-top-width: 1px; }
  .journal-checkout .checkout-cart tbody td {
    border-right-width: 1px;
    border-bottom-width: 1px;
    border-style: solid;
    border-color: #f4f4f4; }
    .journal-checkout .checkout-cart tbody td:first-of-type {
      border-left-width: 1px;
      border-style: solid;
      border-left-color: #f4f4f4; }
    .journal-checkout .checkout-cart tbody td.name {
      padding-right: 5px; }
  .journal-checkout .checkout-cart tbody .total {
    font-weight: normal; }
  .journal-checkout .checkout-cart tfoot td strong {
    font-weight: normal; }
  .journal-checkout .checkout-cart tfoot td:first-of-type {
    border-left-width: 1px;
    border-style: solid;
    border-color: #f4f4f4; }
  .journal-checkout .checkout-cart tfoot td:last-of-type {
    border-right-width: 1px;
    border-style: solid;
    border-color: #f4f4f4; }
  .journal-checkout .checkout-cart tfoot tr:first-of-type td {
    padding-top: 12px; }
  .journal-checkout .checkout-cart tfoot tr:last-of-type td {
    border-bottom-width: 1px;
    border-style: solid;
    border-color: #f4f4f4;
    padding-bottom: 12px; }
  .journal-checkout .checkout-cart td.quantity {
    text-align: center; }
    .journal-checkout .checkout-cart td.quantity input[type='text'] {
      margin-right: 4px;
      border-radius: 4px; }
    .journal-checkout .checkout-cart td.quantity .input-group {
      display: inline-block; }
      .journal-checkout .checkout-cart td.quantity .input-group input {
        position: relative;
        top: 3px; }
  .journal-checkout .checkout-cart td.price,
  .journal-checkout .checkout-cart td.total {
    text-align: center; }
  .journal-checkout .checkout-cart td.image {
    max-width: 70px;
    padding-left: 0;
    border-right: 0; }
    .journal-checkout .checkout-cart td.image img {
      margin-left: 10px;
      max-width: 100%;
      height: auto; }
  .journal-checkout .checkout-cart td.name {
    padding: 0;
    max-width: 155px;
    white-space: normal; }
    .journal-checkout .checkout-cart td.name a {
      font-size: 14px; }
  .journal-checkout input[type='text'],
  .journal-checkout input[type='email'],
  .journal-checkout input[type='password'],
  .journal-checkout input[type='tel'],
  .journal-checkout textarea {
    border-color: #ccc;
    box-shadow: none; }
  .journal-checkout .coupon-voucher {
    display: table;
    width: 100%; }
    .journal-checkout .coupon-voucher .panel-body {
      padding: 0;
      background-color: transparent;
      display: block;
      float: left;
      min-width: 50%; }
      .journal-checkout .coupon-voucher .panel-body label {
        display: none;
        margin-bottom: 4px; }
    .journal-checkout .coupon-voucher .panel-body:nth-of-type(1) {
      padding-right: 12px; }
    .journal-checkout .coupon-voucher .input-group {
      width: 100%; }
    .journal-checkout .coupon-voucher .input-group-btn, .journal-checkout .coupon-voucher input {
      display: inline-block;
      width: 38%;
      border-radius: 0; }
      .journal-checkout .coupon-voucher .input-group-btn .button, .journal-checkout .coupon-voucher input .button {
        width: 100%;
        line-height: 34px; }
    .journal-checkout .coupon-voucher input[type='text'] {
      width: 62%; }
    .journal-checkout .coupon-voucher .panel-body:nth-of-type(3) {
      padding-right: 12px;
      margin-top: 12px; }
  .journal-checkout select {
    margin-left: 0; }
  .journal-checkout .left select, .journal-checkout .section-left select {
    margin-top: 9px; }
  .journal-checkout #shipping-address {
    clear: both; }
  .journal-checkout .customer-group {
    padding-bottom: 7px;
    border-bottom-width: 1px;
    border-bottom-style: solid;
    border-bottom-color: #f4f4f4;
    margin-bottom: 12px; }
    .journal-checkout .customer-group label.control-label {
      padding-top: 0 !important;
      padding-bottom: 10px !important;
      margin: 0 0 5px 0;
      border-bottom-width: 1px;
      border-bottom-style: solid;
      border-bottom-color: #f4f4f4;
      display: block;
      width: 100% !important;
      min-height: 100% !important; }
    .journal-checkout .customer-group div.radio {
      width: 100% !important;
      float: none !important;
      clear: both;
      padding-top: 0; }
      .journal-checkout .customer-group div.radio label {
        width: 100%;
        min-height: 100%;
        padding-top: 0 !important;
        float: none;
        margin-bottom: 0; }

.firefox .journal-checkout .coupon-voucher .button {
  line-height: 32px; }

.oc1 .journal-checkout fieldset {
  border: none;
  padding: 0;
  margin: 0; }
.oc1 .journal-checkout .required {
  color: inherit; }
  .oc1 .journal-checkout .required label {
    font-weight: normal; }
.oc1 .journal-checkout .form-group {
  clear: both;
  margin-bottom: 6px;
  overflow: hidden; }
.oc1 .journal-checkout .input-group .form-control {
  float: left;
  display: table-cell; }
.oc1 .journal-checkout .form-horizontal .form-group label {
  width: 25%;
  float: left;
  display: block;
  padding-top: 7px; }
.oc1 .journal-checkout .form-horizontal .form-group label + div {
  width: 75%;
  float: right; }
.oc1 .journal-checkout .required label:before {
  content: "* ";
  color: red;
  font-weight: bold;
  font-size: 16px;
  position: relative;
  top: 3px;
  margin-right: 3px; }

.oc2 .journal-checkout .checkout-cart td.quantity .input-group input {
  top: 0; }

.ie8 .journal-checkout .coupon-voucher .panel-body label, .ie9 .journal-checkout .coupon-voucher .panel-body label {
  display: block;
  margin-bottom: 4px; }

.payment-pagseguro,
.payment-skrill,
.payment-cod,
.payment-payza,
.payment-pp_standard,
.payment-pp_express,
.payment-coinbase,
.payment-stripe {
  display: none !important; }

.is-customer .journal-checkout .checkout-payment-form #payment-new,
.is-customer .journal-checkout .checkout-payment-form #shipping-new,
.is-customer .journal-checkout .checkout-shipping-form #payment-new,
.is-customer .journal-checkout .checkout-shipping-form #shipping-new {
  margin-top: 12px;
  padding-top: 12px;
  border-top-width: 1px;
  border-top-style: solid;
  border-color: #f4f4f4; }
.is-customer .journal-checkout .checkout-payment-form .secondary-title,
.is-customer .journal-checkout .checkout-shipping-form .secondary-title {
  margin-bottom: 7px; }
.is-customer .journal-checkout .checkout-payment-form form,
.is-customer .journal-checkout .checkout-shipping-form form {
  width: 100%; }
  .is-customer .journal-checkout .checkout-payment-form form > div > select,
  .is-customer .journal-checkout .checkout-shipping-form form > div > select {
    margin-left: 5px;
    margin-top: 5px;
    max-width: 95%; }
.is-customer .journal-checkout section.section-left .form-horizontal .form-group label[for="input-payment-country"],
.is-customer .journal-checkout section.section-left .form-horizontal .form-group label[for="input-payment-zone"],
.is-customer .journal-checkout section.section-left .form-horizontal .form-group label[for="input-shipping-country"],
.is-customer .journal-checkout section.section-left .form-horizontal .form-group label[for="input-shipping-country"] {
  padding-top: 7px; }
.is-customer .journal-checkout .left, .is-customer .journal-checkout .right {
  width: 100%; }
.is-customer .journal-checkout .left {
  display: none; }
.is-customer .journal-checkout section {
  width: 33.3333%;
  float: left; }
  .is-customer .journal-checkout section.section-right {
    padding-left: 18px;
    width: 66.6666%; }
  .is-customer .journal-checkout section.section-left .form-horizontal .form-group label {
    padding: 0 0 0 1px;
    line-height: 100%;
    margin-bottom: 3px; }
  .is-customer .journal-checkout section.section-left .form-horizontal .form-group {
    margin-bottom: 7px; }
  .is-customer .journal-checkout section.section-left .coupon-voucher {
    margin-bottom: 0; }
  .is-customer .journal-checkout section .spw {
    margin-bottom: 0; }
    .is-customer .journal-checkout section .spw > div {
      display: block;
      width: 100%; }

.oc2 .checkout-content .custom-field .radio {
  float: none;
  padding: 0; }

.journal-checkout .left .checkout-register .custom-field .radio label,
.journal-checkout .left .checkout-register .custom-field .checkbox label {
  width: auto;
  min-height: 100%;
  padding-top: 0 !important;
  float: none; }

@media only screen and (min-width: 980px) {
  .is-guest .spw > div:first-of-type {
    padding-right: 0;
    border-right-width: 0; }
  .is-guest .spw > div:last-of-type {
    border-left-width: 0; }
  .is-guest .spw .checkout-shipping-methods {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0; }
  .is-guest .spw .checkout-payment-methods {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0; } }
@media only screen and (min-width: 1100px) {
  .journal-checkout .left .checkout-register label,
  .journal-checkout .left .checkout-login label,
  .journal-checkout section.section-left .form-horizontal .form-group label,
  .oc1 .journal-checkout .form-horizontal .form-group label {
    width: 35%;
    min-height: 33px;
    padding-top: 10px !important;
    float: left; }

  .journal-checkout .customer-group label.control-label {
    padding-top: 0 !important; }

  .journal-checkout .left .checkout-register .checkbox label {
    width: 100%;
    min-height: 100%;
    padding: 0 0 5px 0; }

  .journal-checkout .left .checkout-register label + input,
  .journal-checkout .left .checkout-register label + div,
  .journal-checkout .left .checkout-login label + input,
  .journal-checkout section.section-left .form-horizontal .form-group label + input,
  .journal-checkout section.section-left .form-horizontal .form-group label + div,
  .oc1 .journal-checkout .form-horizontal .form-group label + div {
    width: 65%;
    float: right; }

  .journal-checkout .left .checkout-login label + input + a {
    position: relative;
    top: 5px; }

  .journal-checkout .checkout-cart tbody td.name {
    padding-left: 7px; } }
.mobile .journal-checkout .table-responsive, .tablet .journal-checkout .table-responsive {
  max-height: 100%; }

  /* Control Panel Settings */
.quickview .mfp-iframe-holder .mfp-content{height:530px}
.quickview .heading-title{font-weight: 400;font-family: "Roboto Slab";font-style: normal;font-size: 20px;text-transform: none;color: rgb(255, 255, 255);background-color: rgb(235, 88, 88);padding-left:10px}
#more-details[data-hint]:after{color: rgb(255, 255, 255);background-color: rgb(51, 55, 69)}
#more-details i:before{content: '\e62c';font-size: 30px;color: rgb(255, 255, 255);top: -1px;left: 2px}
.quickview #content{background-color: rgb(228, 228, 228)}
.quickview h1.heading-title{text-align:left}
.label-latest{color: rgb(255, 255, 255);background-color: rgb(105, 185, 207)}
.label-sale{color: rgb(255, 255, 255);background-color: rgb(235, 88, 88)}
header .links > a, .mm-header-link a{color: rgb(255, 255, 255)}
.links .no-link{color: rgb(51, 55, 69)}
.journal-login .journal-secondary a, .journal-secondary .links > a, .mm-header-link a{color: rgb(255, 255, 255)}
.journal-secondary .no-link{color: rgb(51, 55, 69)}
.mega-menu-item h3{font-weight: 700;font-family: "Roboto Slab";font-style: normal;font-size: 13px;text-transform: uppercase;color: rgb(255, 255, 255);background-color: rgb(235, 88, 88);padding-left:7px;padding-top:4px;padding-right:7px;padding-bottom:5px}
.mega-menu-item h3:hover{color: rgb(255, 255, 255);background-color: rgb(105, 185, 207)}
.mega-menu-categories .mega-menu-item ul li a{color: rgb(51, 55, 69)}
.mega-menu-categories .mega-menu-item ul li a:hover{color: rgb(235, 88, 88)}
.mega-menu-brands .mega-menu-item h3{font-weight: 400;font-family: "Oswald";font-style: normal;font-size: 13px;text-transform: uppercase;color: rgb(255, 255, 255);text-align:left;background-color: rgb(234, 35, 73)}
.mega-menu-html .mega-menu-item h3{text-align:left}
.mega-menu-html .mega-menu-item .wrapper{color: rgb(51, 55, 69);padding-top:5px}
.super-menu > li > a{font-weight: 700;font-family: "Roboto Slab";font-style: normal;font-size: 14px;text-transform: uppercase;color: rgb(255, 255, 255);line-height:38px}
.super-menu > li, .super-menu > li:last-of-type, .journal-desktop .menu-floated .float-right{border-left-style:dotted}
.drop-down ul li, .mobile-menu .drop-down ul li, .flyout-menu .fly-drop-down ul li{border-bottom-style:solid;border-color: rgb(244, 244, 244)}
.mega-menu-categories .mega-menu-item h3{text-align:left}
.mega-menu-brands .mega-menu-item img{border-width: 2px;border-style: solid;border-color: rgb(244, 244, 244)}
.mega-menu, .html-menu{background-color: rgb(255, 255, 255)}
.mobile-trigger:before{content: '\e618';font-size: 20px;color: rgb(250, 250, 250);top: -1px}
.drop-down .menu-plus:before{content: '\e60e';font-size: 11px;top: -3px}
.mega-menu-categories .mega-menu-item ul li a:before{content: '\e62c';font-size: 14px}
.mobile-trigger{font-weight: 400;font-family: "Oswald";font-style: normal;font-size: 14px;text-transform: uppercase;color: rgb(255, 255, 255)}
.journal-menu .mobile-menu > li .mobile-plus, .mobile-menu-on-tablet .journal-menu .mobile-menu > li .mobile-plus{background-color: rgb(63, 87, 101);color: rgb(255, 255, 255)}
.journal-header-default .links > a:hover, .journal-header-menu .links > a:hover{background-color: rgb(228, 228, 228)}
.journal-header-default .journal-links, .journal-header-menu .journal-links{background-color: rgb(244, 244, 244)}
.journal-header-default .links > a, .journal-header-menu .links > a{border-color: rgb(228, 228, 228)}
header .links > a:hover, .mm-header-link a:hover{color: rgb(51, 55, 69)}
.super-menu > li, .super-menu.menu-floated{background-color: rgb(51, 55, 69)}
.journal-menu-bg{background-color: rgb(51, 55, 69)}
.super-menu > li:hover > a{color: rgb(255, 255, 255)}
.super-menu > li:hover{background-color: rgb(235, 88, 88)}
.super-menu > li, .super-menu > li:last-of-type, .journal-desktop .menu-floated .float-left, .journal-desktop .menu-floated .float-right{border-color: rgb(95, 104, 116)}
.journal-login .journal-secondary a:hover, .journal-secondary .links > a:hover, .mm-header-link a:hover{color: rgb(51, 55, 69)}
.drop-down ul li:hover > a, .fly-drop-down ul li:hover > a{color: rgb(255, 255, 255)}
.drop-down ul li, .fly-drop-down ul li{background-color: rgb(255, 255, 255)}
.drop-down ul li:hover, .drop-down ul > li:hover > a, .fly-drop-down ul > li:hover > a{background-color: rgb(235, 88, 88)}
.drop-down ul li:hover > a i:before{color: rgb(255, 255, 255)}
.super-menu{border-right-width: 1px;border-left-width: 1px;border-style: dotted;border-color: rgb(95, 104, 116)}
.mega-menu .product-grid-item .price{display:inline-block}
.mega-menu{box-shadow:0 2px 8px -2px rgba(0, 0, 0, 0.4);padding:20px}
.drop-down ul{box-shadow:0 1px 8px -3px rgba(0, 0, 0, 0.5)}
.mega-menu-item > div, #header .mega-menu .product-wrapper{margin-right:15px}
.mega-menu-categories .mega-menu-item ul li.view-more a{font-weight: bold;font-family: Helvetica, Arial, sans-serif;font-style: normal;font-size: 11px;text-transform: none}
.mega-menu-column.mega-menu-html .wrapper p, .mega-menu-column.mega-menu-html .wrapper p span{color: rgb(51, 55, 69)}
.mega-menu-column > div > h3, .mega-menu-column > h3{font-weight: 700;font-family: "Roboto Slab";font-style: normal;font-size: 13px;text-transform: uppercase;color: rgb(255, 255, 255);padding-top:4px;padding-right:7px;margin-bottom:10px;padding-bottom:5px;background-color: rgb(235, 88, 88);padding-left:7px}
.mobile .journal-menu .mobile-menu > li, .tablet.mobile-menu-on-tablet .journal-menu .mobile-menu > li{border-bottom-style:solid}
.quote .button:active{box-shadow:inset 0 1px 10px rgba(0, 0, 0, 0.8)}
.quote .button{color: rgb(255, 255, 255);border-radius: 2px}
.product-info .left .image-additional a{padding:10px 10px 0 0}
.product-info .image .label-latest{display: block}
.product-info .image .label-sale{display: block}
.product-info .image .outofstock{display: block}
.product-options > div, .product-options > ul{margin-bottom:1px;background-color: rgb(244, 244, 244)}
.product-info .right .description .instock{font-weight: bold;font-family: Helvetica, Arial, sans-serif;font-style: normal;font-size: 13px;text-transform: none;color: rgb(51, 153, 101)}
.product-info .right .description .outofstock{font-weight: bold;font-family: Helvetica, Arial, sans-serif;font-style: normal;font-size: 13px;text-transform: none;color: rgb(234, 35, 73)}
.product-info .right .price .price-new, .product-info .right .price .product-price, .product-info .right .price li.price-new, .product-info .right .price li.product-price{font-weight: 400;font-family: "Roboto Slab";font-style: normal;font-size: 35px;text-transform: none;color: rgb(51, 55, 69)}
.product-info .right .price .price-old, .product-info .right .price li.price-old{font-weight: 400;font-family: "Roboto Slab";font-style: normal;font-size: 20px;text-transform: none;color: rgb(255, 255, 255)}
.product-info .right .price-old{background-color: rgb(235, 88, 88)}
.product-info .option > ul > li:active, .product-info .option > ul > li.selected{box-shadow:inset 0 0 8px rgba(0, 0, 0, 0.7)}
#content .product-info .options h3, .ms-sellerprofile.description h3{color: rgb(255, 255, 255);background-color: rgb(169, 184, 192)}
.product-info .option > ul > li{color: rgb(255, 255, 255);background-color: rgb(69, 115, 143)}
#button-cart:active, .product-info .right .cart div .button.enquiry-button:active{box-shadow:inset 0 1px 10px rgba(0, 0, 0, 0.8)}
#button-cart, .product-info .right .cart div .button.enquiry-button{font-weight: 700;font-family: "Roboto Slab";font-style: normal;font-size: 16px;text-transform: uppercase;color: rgb(255, 255, 255)}
.product-info .right .wishlist-compare .links a{font-weight: bold;font-family: Helvetica, Arial, sans-serif;font-style: normal;font-size: 14px;text-transform: none;color: rgb(255, 255, 255)}
.product-info .right .wishlist-compare .links a:hover{color: rgb(51, 55, 69)}
#tabs a, #tabs li a{font-weight: 700;font-family: "Roboto Slab";font-style: normal;font-size: 14px;text-transform: uppercase;color: rgb(255, 255, 255);background-color: rgb(51, 55, 69);box-shadow:none}
.product-info .left .journal-custom-tab h3{font-weight: 700 ;font-family: "Roboto Slab" ;font-style: normal ;font-size: 15px ;text-transform: none }
.product-info .left .journal-custom-tab{background-color: rgb(244, 244, 244);padding-right:10px;padding-bottom:10px;padding-left:10px;padding-top:10px}
.product-info .right .journal-custom-tab h3{font-weight: 700;font-family: "Roboto Slab";font-style: normal;font-size: 15px;text-transform: none}
.product-info .gallery-text:before{content: '\e015';font-size: 16px}
#product-gallery .owl-prev:before{content: '\e62b';font-size: 18px;color: rgb(255, 255, 255);top: -1px;left: -1px}
#product-gallery .owl-next:before{content: '\e62c';font-size: 18px;color: rgb(255, 255, 255);top: -1px;left: 1px}
#button-cart .button-cart-text:before, #button-cart .button-cart-text:after{content: '\e180';font-size: 20px;color: rgb(255, 255, 255);top: 2px}
.product-info .right .wishlist-compare .links a:before{content: '\e662';font-size: 16px}
.product-info .right .wishlist-compare .links a+a:before{content: '\e025';font-size: 16px}
.product-info .right .options .option{border-color: rgb(189, 195, 199)}
.product-info .option > ul > li.selected, .product-info .option > ul > li:hover{color: rgb(255, 255, 255);background-color: rgb(235, 88, 88)}
.product-info .right .cart div .journal-stepper{color: rgb(255, 255, 255);background-color: rgb(169, 184, 192)}
.product-info .right .cart div .journal-stepper:hover{color: rgb(255, 255, 255);background-color: rgb(51, 55, 69)}
#button-cart:hover, .product-info .right .cart div .button.enquiry-button:hover, .quickview #more-details:hover{color: rgb(255, 255, 255)}
.product-info .right .wishlist-compare{background-color: rgb(169, 184, 192)}
#tabs a:hover, #tabs a.selected, #tabs li a:hover, #tabs li.active a{color: rgb(255, 255, 255);background-color: rgb(235, 88, 88)}
.product-info .tab-content, .tab-content, .quickview .tab-content{background-color: rgb(244, 244, 244)}
.tags a{background-color: rgb(235, 88, 88)}
.tags a:hover{background-color: rgb(105, 185, 207);color: rgb(255, 255, 255)}
.tags b{background-color: rgb(51, 55, 69);color: rgb(255, 255, 255)}
.tags{text-align:left}
.tags a, .tags b{border-radius: 15px}
.product-info .right > div > div, .product-info .right > div > ul{padding-left:10px;padding-top:10px;padding-right:10px;padding-bottom:10px}
#product-gallery .owl-buttons.side-buttons div{width:22px;height:22px; line-height:22px;background-color: rgb(235, 88, 88);margin-top:-5px}
#product-gallery .owl-buttons.side-buttons div:hover{background-color: rgb(69, 115, 143)}
#product-gallery .owl-next:hover:before, #product-gallery .owl-prev:hover:before{color: rgb(255, 255, 255)}
.attribute tbody td{text-align:left}
.product-sold-count-text{font-weight: 400;font-family: "Roboto Slab";font-style: normal;font-size: 15px;text-transform: none}
.product-page .heading-title{text-align:left}
.attribute tr td:first-child{text-align:left}
body{font-weight: 400;font-family: "Roboto";font-style: normal;font-size: 13px;text-transform: none;color: rgb(51, 55, 69);background-repeat: repeat;background-position: center top;background-attachment: scroll;background-color: rgb(255, 255, 255)}
.heading-title, .box-heading, #blogArticle .articleHeader h1, .oc-filter .panel-heading{text-align:left;line-height:38px;background-color: rgb(235, 88, 88)}
.secondary-title, #content #review-title{text-align:left;font-weight: bold;font-family: Helvetica, Arial, sans-serif;font-style: normal;font-size: 14px;text-transform: none;color: rgb(255, 255, 255);padding-top:8px; padding-bottom:8px;padding-left:10px; padding-right:10px;background-color: rgb(95, 104, 116)}
.heading-title, .box-heading, #blogArticle .articleHeader h1, #swipebox-caption, .journal-carousel .htabs.single-tab a:hover, .journal-carousel .htabs.single-tab a.selected, .oc-filter .panel-heading{font-weight: 400;font-family: "Roboto Slab";font-style: normal;font-size: 17px;text-transform: none;color: rgb(255, 255, 255)}
.button:active, #quickcheckout .button:active, .modal-footer .btn:active{box-shadow:inset 0 1px 10px rgba(0, 0, 0, 0.8)}
.button, .side-column .box-content a.button, #quickcheckout .button, .modal-footer .btn{font-weight: 700;font-family: "Roboto";font-style: normal;font-size: 14px;text-transform: none;color: rgb(255, 255, 255)}
.button, #quickcheckout .button, .modal-footer .btn{padding:0 10px;line-height:30px;background-color: rgb(235, 88, 88)}
.breadcrumb{font-weight: bold;font-family: Helvetica, Arial, sans-serif;font-style: normal;font-size: 12px;text-transform: none;background-color: rgb(244, 244, 244);border-color: rgb(228, 228, 228);padding-left:0px; padding-right:0px;;display:block}
.scroll-top:before{content: '\e021';font-size: 45px;color: rgb(63, 87, 101)}
#container{background-attachment: scroll;background-color: rgb(255, 255, 255)}
.extended-layout .extended-container{background-attachment: scroll;background-color: rgb(255, 255, 255)}
a{color: rgb(235, 88, 88)}
a:hover{color: rgb(105, 185, 207)}
.button:hover, .side-column .box-content a.button:hover, #quickcheckout .button:hover, .modal-footer .btn:hover{color: rgb(255, 255, 255)}
.button:hover, #quickcheckout .button:hover, .modal-footer .btn:hover{background-color: rgb(51, 55, 69);border-color: rgb(235, 88, 88)}
.breadcrumb a:hover{color: rgb(235, 88, 88)}
.scroll-top:hover:before{color: rgb(105, 185, 207)}
.heading-title, .box-heading, #blogArticle .articleHeader h1, .journal-carousel .htabs.single-tab a, .oc-filter .panel-heading{padding-left:10px}
.extended-container:before{background-color: rgb(244, 244, 244)}
.box-sections ul li, .custom-sections .box-heading.box-sections{border-right-style:solid;border-color: rgb(255, 255, 255)}
.custom-sections .box-heading{border-bottom-width: 0px;border-style: solid;background-color: rgb(235, 88, 88)}
.box-sections ul li a{font-weight: 700;font-family: "Roboto Slab";font-style: normal;font-size: 15px;text-transform: uppercase;color: rgb(255, 255, 255);line-height:38px}
.box-sections ul li a:hover, .box-sections ul li a.selected{color: rgb(255, 255, 255);background-color: rgb(51, 55, 69)}
#footer{margin-top:20px;margin-bottom:0px}
footer .column > h3{border-bottom-style:dotted;text-align:left;font-weight: 400;font-family: "Roboto Slab";font-style: normal;font-size: 15px;text-transform: uppercase;color: rgb(255, 255, 255);border-color: rgb(95, 104, 116)}
footer .column-menu-wrap > ul li{font-weight: normal;font-family: Helvetica, Arial, sans-serif;font-style: normal;font-size: 14px;text-transform: none;color: rgb(255, 255, 255)}
footer .contacts{box-shadow:none;border-top-width: 1px;border-style: dotted;border-color: rgb(95, 104, 116)}
footer .contacts [data-hint]:after{border-radius: 3px;color: rgb(255, 255, 255);background-color: rgb(235, 88, 88)}
.bottom-footer{box-shadow:none;background-color: rgb(235, 88, 88)}
footer, .boxed-footer #footer{background-color: rgb(51, 55, 69)}
footer .column-menu-wrap > ul li:hover a{color: rgb(235, 88, 88)}
footer .column-text-wrap{color: rgb(255, 255, 255)}
footer .contacts i{background-color: rgb(69, 115, 143)}
footer a .contacts-text:hover{color: rgb(235, 88, 88)}
footer .contacts-text{font-weight: 400;font-family: "Roboto Slab";font-style: normal;font-size: 18px;text-transform: none;color: rgb(255, 255, 255)}
.fullwidth-footer, .boxed-footer #footer{background-repeat: repeat;background-position: center top;background-attachment: scroll}
.bottom-footer .copyright a:hover{color: rgb(51, 55, 69)}
.bottom-footer .copyright a{color: rgb(244, 244, 244)}
.bottom-footer .copyright{color: rgb(255, 255, 255)}
.column.products .product-grid-item{padding:6px 0;border-bottom-style:dotted;border-color: rgb(95, 104, 116)}
.column.products .product-grid-item .name a, .footer-post-title{color: rgb(255, 255, 255)}
.column.products .product-grid-item .name a:hover{color: rgb(105, 185, 207)}
.column.products .product-grid-item .price, .column.products .product-grid-item .price-new{color: rgb(255, 255, 255)}
.column.products .product-grid-item .name a{white-space:nowrap}
footer .column-text-wrap p{line-height:16px}
.footer-post{padding:7px 0;border-bottom-style:dotted;border-color: rgb(95, 104, 116)}
.footer-post-title{white-space:nowrap; line-height:1.1;}
.journal-top-header{box-shadow:none;background-color: rgb(235, 88, 88)}
#cart .heading i{border-left-style:solid;background-color: rgb(51, 55, 69)}
.mini-cart-info table tr{border-bottom-style:solid;border-bottom-color: rgb(244, 244, 244)}
#cart .content .cart-wrapper{box-shadow:0 2px 5px rgba(0, 0, 0, 0.10)}
#cart .heading, .ie9 #cart button.heading{font-weight: normal;font-family: Helvetica, Arial, sans-serif;font-style: normal;font-size: 14px;text-transform: none;color: rgb(51, 55, 69)}
.journal-header-center #cart{border-width: 1px;border-style: solid;border-color: rgb(51, 55, 69);background-color: rgb(255, 255, 255)}
.mini-cart-info table tr td.image img{border-width: 3px;border-style: solid;border-color: rgb(244, 244, 244)}
.mini-cart-info{max-height:298px}
.mini-cart-total{font-weight: bold;font-family: Helvetica, Arial, sans-serif;font-style: normal;font-size: 14px;text-transform: none;background-color: rgb(228, 228, 228)}
.button-search, .journal-header-center .button-search{border-right-style:solid}
#search input{background-color: rgb(255, 255, 255)}
.journal-header-center #search input{border-width: 1px;border-style: solid;border-color: rgb(51, 55, 69);background-color: rgb(255, 255, 255)}
.autocomplete2-suggestions{box-shadow:0 1px 8px -3px rgba(0,0,0,.5);background-color: rgb(255, 255, 255)}
.autocomplete2-suggestion span.p-price{display:block}
.autocomplete2-suggestions > div{max-height:350px}
.journal-language .dropdown-menu > li, .journal-currency .dropdown-menu > li{border-top-style:solid;border-top-style:solid}
.journal-language .dropdown-menu, .journal-currency .dropdown-menu{border-radius: 3px;background-color: rgb(255, 255, 255);box-shadow:0 2px 2px rgba(0, 0, 0, 0.15)}
.journal-currency form .currency-symbol{border-radius: 50%;background-color: rgb(255, 255, 255)}
#cart .heading i:before{content: '\e180';font-size: 22px;color: rgb(255, 255, 255);top: -1px}
.button-search i:before{content: '\e697';font-size: 20px;color: rgb(255, 255, 255)}
header, .journal-header-center{background-color: rgb(244, 244, 244);background-repeat: repeat;background-position: center top;background-attachment: scroll}
.journal-header-default #logo, .journal-header-menu #logo{background-color: rgb(255, 255, 255)}
.journal-cart{background-color: rgb(234, 35, 73)}
#cart .content .cart-wrapper, .oc2 #cart .checkout{background-color: rgb(255, 255, 255)}
.mini-cart-info table tr td.remove i{color: rgb(235, 88, 88)}
.mini-cart-info table tr td.remove i:hover, .firefox .mini-cart-info table tr td.remove button:hover i{color: rgb(105, 185, 207)}
.autocomplete2-suggestion{border-bottom-style:solid;border-color: rgb(244, 244, 244)}
.autocomplete2-suggestion:hover{background-color: rgb(250, 250, 250)}
.button-search:hover i:before{color: rgb(255, 255, 255)}
.button-search{background-color: rgb(51, 55, 69);border-color:rgb(51, 55, 69)}
.button-search:hover{background-color: rgb(235, 88, 88)}
.journal-language .dropdown-menu > li > a, header .journal-currency .dropdown-menu > li > a{color: rgb(51, 55, 69)}
.journal-language .dropdown-menu > li > a:hover, header .journal-currency .dropdown-menu > li > a:hover{color: rgb(51, 55, 69)}
.journal-language .dropdown-menu > li > a:hover, .journal-currency .dropdown-menu > li > a:hover{background-color: rgb(244, 244, 244)}
.journal-header-center .journal-language form > div, .journal-header-center .journal-currency form > div{border-color: rgb(221, 0, 23)}
header{box-shadow:none}
#cart{box-shadow:0 1px 5px -2px rgba(0, 0, 0, 0.6)}
.journal-header-center .journal-top-header, .journal-header-center .journal-secondary{border-bottom-style:solid; border-top-style:solid;;border-color: rgb(51, 153, 101)}
.journal-header-mega #logo a{text-align:left}
.autocomplete2-suggestion .p-image{display:block}
.product-wrapper{border-width: 3px;border-style: solid;border-color: rgb(244, 244, 244);background-color: rgb(255, 255, 255);box-shadow:none}
.product-wrapper:hover{border-color: rgb(235, 88, 88)}
.product-grid-item .image .label-latest{display: block}
.product-grid-item .image .label-sale{display: block}
.product-grid-item .image .outofstock{display: block}
.product-grid-item .name a, .posts h2 a{white-space:nowrap;font-weight: normal;font-family: Helvetica, Arial, sans-serif;font-style: normal;font-size: 14px;text-transform: none;color: rgb(51, 55, 69)}
.product-grid-item .price{display:inline-block;;border-top-width: 1px;border-bottom-width: 1px;border-style: solid;border-color: rgb(228, 228, 228);padding-top:5px;padding-right:5px;padding-bottom:5px;padding-left:5px;display:inline-block}
.product-details:before{font-size: 25px;color: rgb(255, 255, 255)}
.product-grid-item .cart .button:active{box-shadow:inset 0 1px 10px rgba(0, 0, 0, 0.8)}
.product-grid-item .cart .button{background-color: rgba(0, 0, 0, 0)}
.product-grid-item .cart .button[data-hint]:after{background-color: rgb(235, 88, 88)}
.product-grid-item .quickview-button .button:active{box-shadow:inset 0 1px 10px rgba(0, 0, 0, 0.8)}
.product-grid-item .quickview-button {margin-left: -19px;margin-top: -20px}
.product-grid-item .quickview-button .button{border-radius: 50%}
.product-grid-item .quickview-button .button[data-hint]:after{color: rgb(255, 255, 255);background-color: rgb(51, 55, 69)}
.product-grid-item.display-icon .wishlist-icon, .product-grid-item.display-icon .compare-icon{border-radius: 50%;width:25px;height:25px; padding:0;}
.product-grid-item .wishlist [data-hint]:after, .product-grid-item .compare [data-hint]:after{color: rgb(255, 255, 255);background-color: rgb(235, 88, 88)}
.product-grid-item .cart .button-left-icon:before, .product-grid-item .cart .button-right-icon:before{content: '\e180';font-size: 18px;color: rgb(51, 55, 69)}
.product-grid-item .quickview-button .button-left-icon:before, .product-grid-item .quickview-button .button-right-icon:before{content: '\e015';font-size: 22px;color: rgb(255, 255, 255);top: -1px}
.product-grid-item .wishlist-icon:before{content: '\e662';font-size: 17px;color: rgb(51, 55, 69)}
.product-grid-item .compare-icon:before{content: '\e025';font-size: 17px;color: rgb(51, 55, 69)}
.product-grid-item .price, .product-grid-item .price-new{font-weight: bold;font-family: Helvetica, Arial, sans-serif;font-style: normal;font-size: 15px;text-transform: none;color: rgb(51, 55, 69)}
.product-grid-item .price-old, .compare-info .price-old, .autocomplete2-suggestion span.p-price .price-old{color: rgb(234, 35, 73)}
.product-grid-item .wishlist a, .product-grid-item .compare a{font-weight: normal;font-family: Helvetica, Arial, sans-serif;font-style: normal;font-size: 11px;text-transform: none;color: rgb(51, 55, 69)}
.product-grid-item .name a:hover, .side-column .product-grid-item .name a:hover, .posts h2 a:hover{color: rgb(235, 88, 88)}
.product-grid-item .rating{top:-35px;margin-left:-47px;display:block}
.product-grid-item .cart{margin-bottom:10px}
.product-grid-item .description{display:none}
.category-list ul li a, .refine-category-name{color: rgb(51, 55, 69)}
.category-list ul li:after{color: rgb(228, 228, 228)}
.category-list{background-color: rgb(51, 55, 69)}
.refine-image a{background-color: rgb(255, 255, 255);padding:4px}
.refine-image a:hover{background-color: rgb(235, 88, 88)}
.product-filter{background-color: rgb(244, 244, 244)}
.product-filter, .product-compare a{font-weight: bold;font-family: Helvetica, Arial, sans-serif;font-style: normal;font-size: 13px;text-transform: none;color: rgb(51, 55, 69)}
.pagination b, .pagination a:hover{color: rgb(255, 255, 255)}
.category-list ul li a:hover, .refine-image a:hover .refine-category-name{color: rgb(255, 255, 255)}
.pagination{background-color: rgb(244, 244, 244);box-shadow:1px 1px 0px rgba(0,0,0,.04)}
.product-filter .display a i:hover, .product-filter .display a.active i{color:rgb(235, 88, 88) !important}
.product-compare a:hover{color: rgb(235, 88, 88)}
#infscr-loading div{color: rgb(241, 196, 15)}
.pagination a, .pagination b, .pagination li{border-radius: 50%}
.pagination a{background-color: rgb(255, 255, 255);color: rgb(51, 55, 69)}
.pagination b, .pagination a:hover, .pagination li.active {background-color: rgb(235, 88, 88)}
.pagination .results, .dataTables_info{font-weight: bold;font-family: Helvetica, Arial, sans-serif;font-style: normal;font-size: 13px;text-transform: none}
.category-page .heading-title{text-align:left}
.tp-bannertimer, .tp-bannertimer.tp-bottom{height:3px;background-color: rgb(235, 88, 88)}
.tp-bullets.tp-thumbs .bullet:before{opacity:.4}
.tp-bullets.tp-thumbs .bullet.selected:before, .tp-bullets.tp-thumbs .bullet:hover:before{opacity:0}
.tp-bullets.tp-thumbs{border-width: 5px;border-radius: 3px;border-style: solid;border-color: rgb(255, 255, 255)}
.tp-leftarrow:before, .tp-leftarrow.default:before, .journal-simple-slider .owl-controls .owl-buttons .owl-prev:before{content: '\e62b';font-size: 60px;color: rgb(255, 255, 255)}
.tp-rightarrow:before, .tp-rightarrow.default:before, .journal-simple-slider .owl-controls .owl-buttons .owl-next:before{content: '\e62c';font-size: 60px;color: rgb(255, 255, 255)}
.tp-bullets.simplebullets.round .bullet.selected, .tp-bullets.simplebullets.round .bullet:hover, .journal-simple-slider .owl-controls .owl-page.active span, .journal-simple-slider .owl-controls.clickable .owl-page:hover span{background-color: rgb(235, 88, 88)}
.tp-bullets.simplebullets.round .bullet, .journal-simple-slider .owl-controls .owl-page span{background-color: rgb(255, 255, 255);border-radius: 50%;margin-left:12px;width:12px;height:12px}
.tp-leftarrow:hover:before, .tp-leftarrow.default:hover:before, .tp-rightarrow:hover:before, .tp-rightarrow.default:hover:before, .journal-simple-slider .owl-controls .owl-buttons .owl-prev:hover:before, .journal-simple-slider .owl-controls .owl-buttons .owl-next:hover:before{color: rgb(235, 88, 88)}
.journal-carousel .htabs a, .side-column .journal-carousel .htabs a{border-right-style:solid;border-color: rgb(255, 255, 255)}
.journal-carousel .owl-prev:before{content: '\e60f';font-size: 20px;color: rgb(255, 255, 255);left: -1px}
.journal-carousel .owl-next:before{content: '\e60e';font-size: 20px;color: rgb(255, 255, 255);left: 1px}
.owl-controls .owl-page span{background-color: rgb(51, 55, 69);border-radius: 50%;width:12px;height:12px}
.journal-carousel .owl-prev:hover:before, .journal-carousel .owl-next:hover:before{color: rgb(69, 115, 143)}
.owl-controls .owl-page.active span, .owl-controls.clickable .owl-page:hover span{background-color: rgb(235, 88, 88)}
.journal-carousel .htabs a:hover, .journal-carousel .htabs a.selected{color: rgb(255, 255, 255);background-color: rgb(51, 55, 69)}
.journal-carousel .owl-buttons .owl-next{right:0px}
.journal-carousel .owl-buttons.side-buttons .owl-next{right:10px}
.journal-carousel .owl-buttons div{width:32px;height:32px; line-height:32px;;top:-57px;border-radius: 50%}
.journal-carousel .owl-buttons.side-buttons div{background-color: rgb(51, 55, 69);margin-top:-17px}
.journal-carousel .owl-buttons.side-buttons div:hover{background-color: rgb(105, 185, 207)}
.journal-carousel .owl-buttons.side-buttons .owl-prev{left:10px}
.journal-carousel .owl-buttons .owl-prev{right:25px}
.journal-carousel .side-buttons .owl-prev:hover:before, .journal-carousel .side-buttons .owl-next:hover:before{color: rgb(255, 255, 255)}
.journal-carousel.carousel-product .product-wrapper{box-shadow:none}
.journal-carousel.carousel-brand .product-wrapper{box-shadow:none}
.journal-carousel.carousel-brand .owl-buttons.side-buttons div, .journal-carousel.journal-gallery .owl-buttons.side-buttons div {margin-top:-20px}
.cart-info tbody td, .wishlist-info tbody td, .compare-info td{border-bottom-style:solid;border-color: rgb(228, 228, 228)}
.cart-info .image a img, .wishlist-info .image a img, .compare-info tbody tr:first-of-type + tr > td img{border-width: 3px;border-style: solid;border-color: rgb(228, 228, 228)}
.action-area h3{color: rgb(255, 255, 255);background-color: rgb(169, 184, 192)}
.buttons{border-top-width: 1px;border-style: solid;border-color: rgb(228, 228, 228);padding-top:15px; padding-bottom:15px;}
.cart-info table, .wishlist-info table, .compare-info td, table.list tbody td, .order-list .order-content{background-color: rgb(250, 250, 250)}
.cart-info tbody td, .wishlist-info tbody td, .compare-info td, table.list tbody td, .order-list .order-content{color: rgb(51, 55, 69)}
.cart-info thead td, .wishlist-info thead td, .compare-info thead td, .manufacturer-heading, table.list thead td, table.list, table.list td, .order-list .order-id, .order-list .order-status{color: rgb(244, 244, 244)}
.cart-info thead td, .wishlist-info thead td, .compare-info thead td, .manufacturer-heading, table.list thead td, .order-list .order-id, .order-list .order-status{background-color: rgb(169, 184, 192)}
.login-content > div, .sitemap-info ul{background-color: rgb(250, 250, 250)}
.login-content hr{background-color: rgb(228, 228, 228)}
#content.sc-page .content p, #content.sc-page .action-area p, .cart-total, table.list tfoot td{color: rgb(51, 55, 69);background-color: rgb(244, 244, 244)}
table.radio .highlight:hover td label, .action-area .panel-title:hover a{color: rgb(255, 255, 255)}
table.radio .highlight td, .action-area .panel-heading{background-color: rgb(255, 255, 255)}
table.radio .highlight:hover td, .action-area .panel-heading:hover{background-color: rgb(169, 184, 192)}
#content.sc-page .content table.radio .highlight td{border-color: rgb(244, 244, 244)}
.checkout-heading, .checkout .panel-heading{background-color: rgb(51, 55, 69)}
.checkout-heading{border-color: rgb(95, 104, 116);border-bottom-style:dotted}
.checkout-product thead td, .checkout-product tfoot td{color: rgb(51, 55, 69);background-color: rgb(244, 244, 244)}
.checkout-product tbody td{border-color: rgb(244, 244, 244)}
.checkout-content, .checkout-page .panel-body{background-color: rgb(250, 250, 250)}
.checkout-content, .checkout-page .panel-body {padding:12px}
.checkout-heading, .checkout .panel-title{color: rgb(255, 255, 255)}
.information-page #content h1.heading-title{text-align:left}
#container.maintenance-message, .extended-container #container.maintenance-message{background-attachment: scroll}
table.radio .highlight td label, .action-area .panel-title{color: rgb(63, 87, 101)}
.ui-pnotify {display: block !important;background-color: rgb(255, 255, 255)}
.ui-pnotify-text img {display: block}
.ui-pnotify-title {font-weight: bold;font-family: Helvetica, Arial, sans-serif;font-style: normal;font-size: 14px;text-transform: none;color: rgb(255, 255, 255);background-color: rgb(95, 104, 116)}
.ui-pnotify-closer{color: rgb(255, 255, 255)}
.ui-pnotify-closer:hover{color: rgb(235, 88, 88)}
.notification-buttons{display:block}
.journal-sf ul label img{border-width: 2px;border-style: solid;border-color: rgb(228, 228, 228)}
.sf-icon .sf-reset-icon:after{content: '\e025';font-size: 20px;color: rgb(255, 255, 255)}
.sf-price .ui-widget-header{background-color: rgb(51, 55, 69)}
.sf-price .value{color: rgb(255, 255, 255);background-color: rgb(51, 55, 69);border-radius: 3px}
.sf-price .ui-slider-handle:hover{background-color: rgb(235, 88, 88)}
.sf-price .ui-slider-handle{background-color: rgb(51, 55, 69);border-radius: 50%;height:16px;top:-7px;width:16px}
.journal-sf ul label.sf-checked img{border-color: rgb(69, 115, 143)}
.side-column .journal-sf .box ul li label.sf-checked, .side-column .journal-sf .box ul li label:hover{color: rgb(235, 88, 88)}
.sf-reset{color: rgb(255, 255, 255)}
.sf-reset:hover{color: rgb(51, 55, 69)}
.sf-icon:after{color: rgb(255, 255, 255);background-color: rgb(51, 55, 69)}
.side-column .journal-sf .box ul li{border-color: rgb(228, 228, 228);padding-left:10px;padding-top:5px;padding-bottom:5px;border-bottom-style:solid}
.sf-price .box-content{padding-bottom:40px;padding-left:25px;padding-right:25px;padding-top:20px}
.sf-price .ui-slider-horizontal{height:3px}
.journal-sf .sf-image .box-content ul li{padding-bottom:5px;padding-right:5px;width:16.666666%}
.side-column .journal-sf .box ul li label{font-weight: bold;font-family: Helvetica, Arial, sans-serif;font-style: normal;font-size: 13px;text-transform: none}
.journal-sf .sf-image .box-content{padding-left:8px;padding-top:8px;padding-right:8px;padding-bottom:8px}
.sf-price .ui-widget-content{background: rgb(235, 88, 88)}
.journal-sf .box-content{max-height:300px}
.journal-sf .sf-category.sf-image .box-content ul li{width:25%}
.journal-sf .sf-manufacturer.sf-image .box-content ul li{width:25%}
.side-column .block-content{padding:8px}
.side-column .box.cms-blocks .cms-block{margin-bottom:1px}
.side-column .box.cms-blocks .block-content{background-color: rgb(244, 244, 244)}
.side-column .block-content p{font-weight: normal;font-family: Helvetica, Arial, sans-serif;font-style: normal;font-size: 12px;text-transform: none;line-height:14px}
.editor-content h1, .editor-content h2, .editor-content h3, .side-block-content h1, .side-block-content h3, .side-block-content h3{font-weight: 400 ;font-family: "Roboto Slab" ;font-style: normal ;font-size: 18px ;text-transform: none ;padding-bottom:7px}
.editor-content p, .side-block-content p{padding-bottom:5px;line-height:15px}
.side-column .editor-content h1, .side-column .editor-content h2, .side-column .editor-content h3{padding-bottom:3px;font-weight: 700 !important;font-family: "Roboto Slab" !important;font-style: normal !important;font-size: 15px !important;text-transform: none !important}
.nav-numbers a{background-color: rgb(51, 55, 69);border-radius: 50%;width:12px;height:12px}
.nav-numbers a:hover, .nav-numbers li.active a{background-color: rgb(235, 88, 88)}
.gallery-thumb a:before{content: '\e015';font-size: 30px;color: rgb(255, 255, 255)}
#swipebox-close:before{content: '\e601';font-size: 30px;color: rgb(255, 255, 255)}
#swipebox-prev:before{content: '\e093';font-size: 30px;color: rgb(255, 255, 255)}
#swipebox-next:before{content: '\e094';font-size: 30px;color: rgb(255, 255, 255)}
.gallery-thumb .item-hover{background-color: rgba(0, 0, 0, 0.5)}
#swipebox-overlay{background-color: rgba(0, 0, 0, 0.75)}
#swipebox-action, #swipebox-caption{background-color: rgb(69, 115, 143);color: rgb(255, 255, 255)}
#swipebox-close:hover:before{color: rgb(235, 88, 88)}
#swipebox-prev:hover:before, #swipebox-next:hover:before{color: rgb(235, 88, 88)}
.side-column .journal-gallery .box-content{padding:10px !important}
.product-list-item{background-color: rgb(244, 244, 244)}
.product-list-item .image .label-latest{display: block}
.product-list-item .image .label-sale{display: block}
.product-list-item .image .outofstock{display: block}
.product-list-item .description{display:block}
.product-list-item .cart .button:active{box-shadow:inset 0 1px 10px rgba(0, 0, 0, 0.8)}
.product-list-item .cart .button[data-hint]:after{border-radius: 3px;color: rgb(255, 255, 255);background-color: rgb(66, 139, 202)}
.product-list-item .quickview-button .button:active{box-shadow:inset 0 1px 10px rgba(0, 0, 0, 0.8)}
.product-list-item .quickview-button {margin-left: -20px;margin-top: -20px}
.product-list-item .quickview-button .button{border-radius: 50px}
.product-list-item .quickview-button .button[data-hint]:after{color: rgb(255, 255, 255);background-color: rgb(105, 185, 207)}
.product-list-item .wishlist a, .product-list-item .compare a{color: rgb(51, 55, 69)}
.product-list-item .cart .button-left-icon:before, .product-list-item .cart .button-right-icon:before{content: '\e000';font-size: 23px;color: rgb(255, 255, 255)}
.product-list-item .quickview-button .button-left-icon:before, .product-list-item .quickview-button .button-right-icon:before{content: '\e015';font-size: 20px;color: rgb(255, 255, 255)}
.product-list-item .wishlist-icon:before{content: '\e662';font-size: 11px;color: rgb(51, 55, 69)}
.product-list-item .compare-icon:before{content: '\e025';font-size: 11px;color: rgb(51, 55, 69)}
.product-list-item .wishlist a:hover, .product-list-item .compare a:hover{color: rgb(234, 35, 73)}
.side-column .box-content li a, .side-column .box-category li a, .flyout-menu .flyout > ul > li > a,  .journal-sf ul li, .side-column .oc-module .product-grid-item, #column-right .recentArticles li, #column-right .popularArticles li, #column-left .recentArticles li, #column-left .popularArticles li, .side-post + hr{border-bottom-style:solid}
.side-column .box-category li a img, .side-column .oc-module .product-grid-item .image img{border-width: 3px;border-style: solid;border-color: rgb(244, 244, 244)}
.side-column .side-category-accordion i{background-color: rgb(235, 88, 88)}
.side-column .side-category-accordion i:hover{color: rgb(255, 255, 255);background-color: rgb(105, 185, 207)}
.side-column .box-category li a:before, .flyout-menu .flyout > ul > li > a:before, .side-column .box-content li a:before{content: '\e62c';font-size: 15px;top: -2px}
.side-column .box-content li a, .side-column .store-picker, .side-column .box, .side-column .box-category li a, .flyout-menu .flyout > ul > li > a, .side-column .oc-module .product-grid-item, #column-right .recentComments li, #column-left .recentComments li, #column-right .recentArticles li, #column-right .popularArticles li, #column-left .recentArticles li, #column-left .popularArticles li, .side-column .oc-store{background-color: rgb(244, 244, 244)}
.side-column, .side-column .oc-module .product-grid-item .price, .journal-sf ul li label, .side-post-title{color: rgb(51, 55, 69)}
.side-column .box-content li a:hover, .side-column .box-category li a:hover, .flyout-menu .flyout > ul > li:hover > a, .flyout-menu .flyout > ul > li > a:active, .side-column .box-content li a.active, .side-column .box-category li a.active{background-color: rgb(255, 255, 255)}
.side-column .box-content li a, .side-column .box-category li a, .flyout-menu .flyout > ul > li > a, .journal-sf ul li, .side-column .oc-module .product-grid-item, #column-right .recentArticles li, #column-right .popularArticles li, #column-left .recentArticles li, #column-left .popularArticles li, .side-post + hr {border-color:rgb(228, 228, 228)}
.side-column .heading-title, .side-column .box-heading, .side-column #blogArticle .articleHeader h1, .oc-filter .panel-heading{background-color: rgb(235, 88, 88);border-bottom-width: 0px;border-style: solid;padding-left:10px}
.side-column .box-content li a, .side-column .box-category li a{padding-top:10px;padding-right:25px;padding-bottom:10px;padding-left:10px}
.side-column .oc-module .product-grid-item{padding-top:5px;padding-right:5px;padding-bottom:5px;padding-left:5px}
.side-column .side-category i{height:20px;top:8px;right:8px;font-weight: normal;font-family: Helvetica, Arial, sans-serif;font-style: normal;font-size: 18px;text-transform: none;color: rgb(255, 255, 255);width:20px}
.side-column .heading-title, .side-column .box-heading, .side-column #blogArticle .articleHeader h1, .side-column .journal-carousel .htabs.single-tab a.selected, .oc-filter .panel-heading, .oc-filter a.list-group-item{font-weight: 400;font-family: "Roboto Slab";font-style: normal;font-size: 16px;text-transform: none}
.side-column .oc-module .product-grid-item .name a{white-space:nowrap}
.side-column .box-content li a, .side-column .box-category li a, .flyout-menu .flyout > ul > li > a, #column-right .recentArticles li > a, #column-right .popularArticles li > a, #column-left .recentArticles li > a, #column-left .popularArticles li > a, .side-post-title{color: rgb(80, 80, 80)}
#content .welcome h1, .side-column .welcome h1{text-align:left;border-color: rgb(228, 228, 228);font-weight: 400;font-family: "Roboto Slab";font-style: normal;font-size: 30px;text-transform: none;color: rgb(51, 55, 69);border-bottom-style:solid}
#content .welcome p, .side-column .welcome p{text-align:left}
.product-grid-item .name{display:table}
.product-info .right .description{display:block}
.product-info .right > div > .options{display:block}
.journal-header-center .journal-cart{display:block}
.product-info .product-options > .cart{display:block}
.journal-header-center #search{display:block}
.product-info .right > div > .price{display:block}
.product-info .right .wishlist-compare .links a:first-of-type{display:inline-block;}
.product-info .right .wishlist-compare .links a + a{display:inline-block}
.product-grid-item .compare, .product-filter .product-compare{display:inline-block}
.product-grid-item .wishlist{display:inline-block}
.journal-carousel .product-grid-item .cart{display:block}
.custom-sections .product-grid-item .price{display:inline-block}
.product-list-item .name{display:table}
.mega-menu .product-grid-item .wishlist{display:inline-block}
.mega-menu .product-grid-item .compare{display:inline-block}
.journal-carousel .product-grid-item .wishlist{display:inline-block}
.product-list-item .wishlist{display:inline-block}
.product-list-item .price{display:inline-block}
.side-column .journal-carousel .product-grid-item .wishlist{display:inline-block}
.journal-carousel .product-grid-item .compare{display:inline-block}
.side-column .journal-carousel .product-grid-item .price{display:inline-block}
.product-list-item .compare{display:inline-block}
.product-list-item .cart{display:block}
.journal-carousel .product-grid-item .price{display:inline-block}
.journal-carousel .product-grid-item .name{display:table}
.mega-menu .product-grid-item .cart{display:block}
.side-column .journal-carousel .product-grid-item .compare{display:inline-block}
.side-column .journal-carousel .product-grid-item .cart{display:block}
.custom-sections .product-grid-item .wishlist{display:inline-block}
.custom-sections .product-grid-item .cart{display:block}
.side-column .journal-carousel .product-grid-item .name{display:table}
.custom-sections .product-grid-item .compare{display:inline-block}
.custom-sections .product-grid-item .name{display:table}
.mega-menu .product-grid-item .name{display:table}
.countdown > span{border-right-style:solid}
.product-info .right > div .countdown > span{border-right-style:dotted;font-weight: 400;font-family: "Roboto Slab";font-style: normal;font-size: 22px;text-transform: none;border-color: rgb(228, 228, 228)}
.expire-text{padding-left:7px;background-color: rgb(235, 88, 88);padding-top:5px;padding-right:7px;padding-bottom:7px;text-align:left;font-weight: 400;font-family: "Roboto Slab";font-style: normal;font-size: 16px;text-transform: none;color: rgb(255, 255, 255)}
.countdown{background-color: rgb(51, 153, 101)}
.posts .post-wrapper h2 a{white-space:nowrap;font-weight: 400;font-family: "Roboto Slab";font-style: normal;font-size: 18px;text-transform: none}
.post-view-more.button:hover{color: rgb(235, 88, 88);background-color: rgb(255, 255, 255);border-color: rgb(235, 88, 88)}
.post-item-details{padding-left:15px;padding-bottom:0px;padding-right:15px;padding-top:0px;text-align:left}
.post-item-details .comment-date{border-width: 1px;border-style: solid;border-color: rgb(228, 228, 228);color: rgb(119, 119, 119);padding:7px}
.post-wrapper:hover{background-color: rgb(250, 250, 250);border-color: rgb(235, 88, 88)}
.post-wrapper{background-color: rgb(255, 255, 255);border-width: 3px;border-style: solid;border-color: rgb(238, 238, 238)}
.post-view-more.button{background-color: rgba(235, 88, 88, 0);padding-left:8px;padding-bottom:9px;padding-top:7px;padding-right:8px;font-weight: 400;font-family: "Roboto Slab";font-style: normal;font-size: 14px;text-transform: none;color: rgb(56, 56, 56);border-width: 1px;border-style: solid;border-color: rgb(228, 228, 228)}
.post-button-left-icon:before, .post-button-right-icon:before{content: '\e62c';font-size: 17px;top: 1px}
span.p-comment:before{content: '\e1af';font-size: 13px;color: rgb(235, 88, 88)}
span.p-date:before{content: '\e6b3';font-size: 13px;color: rgb(235, 88, 88)}
span.p-author:before{content: '\e1b8';font-size: 13px;color: rgb(235, 88, 88)}
.posts.blog-list-view .post-item-details h2 a{white-space:nowrap}
.posts.blog-list-view .post-image{width:30%}
.posts.blog-list-view .post-item-details h2 a span{border-bottom-style:solid}
.journal-blog-feed:before{content: '\e6b5';font-size: 16px;color: rgb(255, 255, 255);top: 2px}
.journal-blog-feed{right:15px;color: rgb(255, 255, 255)}
.journal-blog-feed:hover{color: rgb(51, 55, 69)}
.side-blog .box-post{padding-bottom:10px;padding-left:10px;padding-right:10px;padding-top:10px}
.side-blog .side-post + hr{border-bottom-style:solid;border-color: rgb(228, 228, 228)}
.post-module .post-wrapper .post-item-details h2 a{white-space:nowrap}
.post-module .box-heading{text-align:left}
.comments > .comment:nth-of-type(odd){background-color: rgb(238, 238, 238)}
.comments .reply:nth-of-type(even){background-color: rgb(255, 255, 255)}
.comments .reply:nth-of-type(odd){background-color: rgb(250, 250, 250)}
.reply-form .comment-form form{background-color: rgb(255, 255, 255);padding:15px}
.comment-form form{background-color: rgb(238, 238, 238);padding:15px}
.comments > .comment:nth-of-type(even){background-color: rgb(238, 238, 238)}
.post-details .tags a, .side-blog-tags .box-tag a{background-color: rgb(235, 88, 88);color: rgb(255, 255, 255)}
.post-comment h3{background-color: rgb(235, 88, 88);text-align:left;font-weight: 400;font-family: "Roboto Slab";font-style: normal;font-size: 18px;text-transform: none;color: rgb(255, 255, 255);padding-top:12px;padding-left:12px;margin-top:20px;padding-right:12px;padding-bottom:12px}
.post-details .tags a:hover, .side-blog-tags .box-tag a:hover{background-color: rgb(105, 185, 207);color: rgb(255, 255, 255)}
.comments > h3{background-color: rgb(235, 88, 88);margin-top:10px;padding-right:12px;padding-bottom:12px;padding-left:12px;padding-top:12px;text-align:left;font-weight: 400;font-family: "Roboto Slab";font-style: normal;font-size: 18px;text-transform: none;color: rgb(255, 255, 255)}
.reply-form h3{background-color: rgb(235, 88, 88);padding-right:10px;text-align:left;padding-top:10px;font-weight: 400;font-family: "Roboto Slab";font-style: normal;font-size: 17px;text-transform: none;color: rgb(255, 255, 255);margin-top:20px;padding-bottom:10px;padding-left:10px}
.blog-post .social{text-align:left;border-top-style:solid}
.blog-post .heading-title{text-align:left}
.post-stats.comment-date{padding-right:10px;padding-bottom:10px;color: rgb(56, 56, 56);padding-top:10px;padding-left:10px;background-color: rgb(244, 244, 244)}
blockquote{border-color: rgb(235, 88, 88)}
.post-details .tags{text-align:left}
.post-details .tags b{color: rgb(255, 255, 255)}
.comments .user-name{font-weight: 400;font-family: "Roboto Slab";font-style: normal;font-size: 18px;text-transform: none}
.comments .reply .user-name{font-weight: 400;font-family: "Roboto Slab";font-style: normal;font-size: 18px;text-transform: none}
.comment-submit.button, .reply-submit.button, .comments .reply-btn{border-radius: 3px}
.blog-post .post-stats .p-category:before{content: '\e6b2';font-size: 14px;color: rgb(235, 88, 88)}
.blog-post .post-stats{margin-bottom:20px}
.journal-checkout .confirm-order{text-align:left}
.journal-checkout .confirm-button:active{box-shadow:inset 0 1px 10px rgba(0, 0, 0, 0.8)}
.journal-checkout .table-responsive{max-height:412px}
.one-page-checkout .journal-checkout .checkout-product tbody td, .journal-checkout .checkout-cart tbody tr:first-of-type td, .journal-checkout .checkout-cart thead td, .journal-checkout .checkout-cart thead td:first-of-type, .journal-checkout .checkout-cart thead td:last-of-type, .journal-checkout .checkout-cart tfoot tr:last-of-type td, .journal-checkout .checkout-cart tfoot td:first-of-type, .journal-checkout .checkout-cart tfoot td:last-of-type{border-style:solid;border-color: rgb(228, 228, 228)}
.journal-checkout .secondary-title{text-align:left}
.journal-checkout .left .login-box .radio label, .journal-checkout .spw > div .radio label, .journal-checkout .confirm-order, .journal-checkout .checkout-login .form-group:last-of-type, .is-customer .journal-checkout .checkout-payment-form #payment-new, .is-customer .journal-checkout .checkout-shipping-form #shipping-new, .journal-checkout #payment-confirm-button fieldset legend, .journal-checkout .customer-group label.control-label, .journal-checkout .customer-group{border-style:solid;border-color: rgb(228, 228, 228)}
.one-page-checkout h1.heading-title{text-align:left}
.form-group.fax-input{display:block}
.form-group.address-2-input{display:block}
.form-group.company-input{display:block}
.journal-checkout .spw > div p{display:none}
.journal-checkout .coupon-voucher .input-group-btn input.button:active{box-shadow:inset 0 1px 10px rgba(0, 0, 0, 0.8)}
.journal-checkout .checkout-product thead td, .journal-checkout .checkout-product tfoot td{background-color: rgb(255, 255, 255)}
.flyout ul li:hover > a .menu-plus:before{color: rgb(235, 88, 88)}
.flyout .mega-menu-categories .mega-menu-item ul li.view-more a{color: rgb(235, 88, 88)}
.flyout .mega-menu-categories .mega-menu-item ul li.view-more a:hover{color: rgb(105, 185, 207)}
.flyout .mega-menu-categories .mega-menu-item ul li a{color: rgb(255, 255, 255)}
.flyout .mega-menu-categories .mega-menu-item ul li a:hover{color: rgb(105, 185, 207)}
.flyout .mega-menu-categories .mega-menu-item div{padding:10px;border-width: 1px;border-style: dashed;border-color: rgb(63, 87, 101)}
.flyout-menu .flyout > ul > li > a, .fly-drop-down ul li a{font-weight: 400;font-family: "Roboto";font-style: normal;font-size: 14px;text-transform: none}
.flyout .fly-drop-down ul li .menu-plus:before{content: '\e6ae';font-size: 16px;color: rgb(244, 244, 244)}
.fly-mega-menu{background-color: rgb(51, 55, 69);box-shadow:0 2px 8px -2px rgba(0, 0, 0, 0.4)}
.flyout .mega-menu-column > div > h3{text-align:left}
.flyout .mega-menu-brands .mega-menu-item h3{text-align:left}
.flyout-menu .flyout > ul > li > a{border-bottom-style:solid;border-color: rgb(255, 255, 255)}
.flyout .mega-menu-item h3{text-align:left}
.flyout-menu .flyout .fly-drop-down ul li{border-bottom-style:dashed;border-color: rgb(63, 87, 101)}
.fly-drop-down ul{box-shadow:none}
.flyout .fly-drop-down ul li a, .fly-drop-down ul li{background-color: rgb(50, 54, 70)}
.flyout .fly-drop-down ul > li:hover > a, .flyout .fly-drop-down ul > li:hover{background-color: rgb(60, 66, 91)}
.flyout-menu i.menu-plus{top:12px}
.flyout-menu .flyout > ul > li:hover > a{background-color: rgb(238, 238, 238)}
.flyout-menu .flyout > ul > li{height:42px}
.flyout-menu .flyout .fly-drop-down ul > li:hover > a > .menu-plus:before {color: rgb(235, 88, 88)}
.flyout .fly-drop-down ul li a{color: rgb(244, 244, 244)}
.flyout .mega-menu-column.mega-menu-html .wrapper{padding-right:10px;background-color: rgb(244, 244, 244);padding-top:10px;padding-bottom:10px;padding-left:10px}


/* Swipebox Loader */
#swipebox-slider .slide {
  background-image: url('image/data/journal2/loader.gif');
}
.mfp-iframe-scaler iframe{
  background-image: url('image/data/journal2/loader.gif');
  background-repeat: no-repeat;
  background-position: center;
}
.social{
  background-image: url('image/data/journal2/loader.gif');
}





/* Site width */
#container, #header, #footer, .bottom-footer > div, .bottom-footer.boxed-bar {
   max-width: 1280px;
}


.extended-container:before{
  display:block;
}




@media only screen and (max-width:1300px) {
 .journal-header-center .journal-search, .journal-header-center .journal-links{
    padding-left: 15px;
  }
 .journal-header-center .journal-cart, .journal-header-center .journal-secondary{
    padding-right: 15px;
  }
}
@media only screen and (max-width:760px) {
 .journal-header-center .journal-search, .journal-header-center .journal-links{
    padding-left: 0;
  }
 .journal-header-center .journal-cart, .journal-header-center .journal-secondary{
    padding-right: 0;
  }
}





.category-info .image{
display:none;
}

/*Notification Position*/
.ui-pnotify{
right:20px;
}
.ui-pnotify{
        box-shadow:0px 1px 12px rgba(0, 0, 0, 0.2);
}



.ui-pnotify:hover .ui-pnotify-closer{
opacity:1;
}


.breadcrumb{
        text-align:left;
}




/* Product Grid */

.product-wrapper:hover{
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.20);
}




.custom-sections.section-product .product-wrapper:hover{
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.20);
}







.journal-carousel.carousel-product .product-wrapper{
  box-shadow: none;
}





.journal-carousel.carousel-brand .product-wrapper{
  box-shadow: none;
}






.enquiry-button .button i:before{
  color:rgb(51, 55, 69);
}

footer .contacts > div > span:hover a i{
  background-color:rgb(235, 88, 88);
}

.product-grid-item .cart .button-left-icon:before{
 float:none;
}
.product-grid-item .cart .button-right-icon:before{
 margin-left:0;
}
.product-grid-item .cart .button-cart-text{
  display:none;
}
.product-grid-item .cart .button[data-hint]:after,
.product-grid-item .cart .hint--top:before{
  display:block;
}
.product-grid-item .cart .hint--top:before{
  border-top-color: rgb(235, 88, 88);
}
.product-grid-item .cart .hint--right:before{
  border-right-color: rgb(235, 88, 88);
}
.product-grid-item .cart .hint--left:before{
  border-left-color: rgb(235, 88, 88);
}


.product-grid-item .cart .button-right-icon{
display:none;
}




/* BLOG */

.post-button-left-icon{
 display:none;
}
.post-button-right-icon{
 display:inline;
}

.post-wrapper:hover{
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.20) !important;
}



.box.post-module .post-wrapper:hover{
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.20);
}





.blog-list-view .post-wrapper:hover{
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.20) !important;
}




.product-details:before {
  visibility:hidden;
  opacity:0;
  transition: all 0.2s;
}
.product-grid-item:hover .product-details:before {
  visibility:visible;
  opacity:1;
}




/* Product Grid Quickview*/

.product-grid-item:hover .quickview-button {
    opacity: 1;
    visibility: visible;
}




.product-grid-item .quickview-button .button-right-icon{
display:none;
}



.product-grid-item .quickview-button .button-left-icon:before{
 float:none;
}
.product-grid-item .quickview-button .button-right-icon:before{
 margin-left:0;
}
.product-grid-item .quickview-button .button-cart-text{
  display:none;
}
.product-grid-item .quickview-button [data-hint]:after,
.product-grid-item .quickview-button .hint--top:before{
  display:block;
}
.product-grid-item .quickview-button .hint--top:before{
  border-top-color: rgb(51, 55, 69);
}
.product-grid-item .quickview-button .hint--right:before{
  border-right-color: rgb(51, 55, 69);
}
.product-grid-item .quickview-button .hint--left:before{
  border-left-color: rgb(51, 55, 69);
}





/* Product Grid Wishlist/Compare */


.product-grid-item .button-wishlist-text,
.product-grid-item .button-compare-text{
   display: none;
}
.product-grid-item .wishlist [data-hint]:after,
.product-grid-item .wishlist .hint--top:before,
.product-grid-item .compare [data-hint]:after,
.product-grid-item .compare .hint--top:before{
  display:block;
}

.product-grid-item .wishlist .hint--top:before,
.product-grid-item .compare .hint--top:before{
  border-top-color: rgb(235, 88, 88);
}
.product-grid-item .wishlist .hint--right:before,
.product-grid-item .compare .hint--right:before{
  border-right-color: rgb(235, 88, 88);
}
.product-grid-item .wishlist .hint--left:before,
.product-grid-item .compare .hint--left:before{
  border-left-color: rgb(235, 88, 88);
}









.product-list-item .quickview-button .button{
  width:40px;
  height:40px;
  line-height:40px;
  padding:0;
}



.product-grid-item .cart .button{
  width:25px;
  height:25px;
  line-height:25px;
  padding:0;
}
.product-grid-item .cart{
  height:25px;
}

.product-grid-item .quickview-button .button{
  width:40px;
  height:40px;
  line-height:40px;
  padding:0;
}


/* Product List */

.product-list-item:hover{
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.15);
}







.product-list-item .cart .button-left-icon:before{
  margin-right: 8px;
}

.product-list-item .cart .button-right-icon{
display:none;
}





/* Product List Quickview*/
.product-list-item:hover .quickview-button {
    opacity: 1;
    visibility: visible;
}



.product-list-item .quickview-button .button-right-icon{
display:none;
}



.product-list-item .quickview-button .button-left-icon:before{
 float:none;
}
.product-list-item .quickview-button .button-right-icon:before{
 margin-left:0;
}
.product-list-item .quickview-button .button-cart-text{
  display:none;
}
.product-list-item .quickview-button .button[data-hint]:after,
.product-list-item .quickview-button .hint--top:before{
  display:block;
}
.product-list-item .quickview-button .hint--top:before{
  border-top-color: rgb(105, 185, 207);
}
.product-list-item .quickview-button .hint--right:before{
  border-right-color: rgb(105, 185, 207);
}
.product-list-item .quickview-button .hint--left:before{
  border-left-color: rgb(105, 185, 207);
}



/* Product Page */

.product-info .left .image-additional-grid a{
  width: 20%;
}

.product-info .left .image-additional{
  margin-right: -14px;
}

.product-info .gallery-text{
  padding-top: 6px;
}

#button-cart .button-cart-text:after{
display:none;
}




.checkout-content .buttons{
  border-radius:0;
}

.compare-info td{
  border-right-style:solid;
}
table.list{
  border-bottom-style:solid;
  border-left-style:solid;
}
table.list td{
  border-right-style:solid;
  border-top-style:solid;
}



/* Product Labels*/

.label-latest + .label-sale{
  top: px;
}




#more-details.hint--top:before{
  border-top-color: rgb(51, 55, 69);
}



.boxed-header header{
  max-width:1280px;
}
.boxed-header .super-menu > li:first-of-type{
  border-left:0;
}
.boxed-header .super-menu > li:last-of-type{
  border-right:0;
}

.boxed-header .is-sticky header{
  left:50%;
  margin-left:-640px;
}

.boxed-header .journal-header-center .journal-links{
  padding-left: 10px;
}
.boxed-header .journal-header-center .journal-search{
  padding-left: 20px;
}
.boxed-header .journal-header-center .journal-secondary{
  padding-right: 10px;
}
.boxed-header .journal-header-center .journal-cart{
  padding-right: 20px;
}
@media only screen and (max-width: 760px) {
  .boxed-header .journal-header-center .journal-search,
  .boxed-header .journal-header-center .journal-links{
    padding-left: 0;
  }
  .boxed-header .journal-header-center .journal-cart,
  .boxed-header .journal-header-center .journal-secondary{
    padding-right: 0;
  }
}

@media only screen and (max-width: 1295px) {
.boxed-header .is-sticky header{
  left:0;
  margin-left:0;
}
.boxed-header body{
  padding:0;
}
.fullwidth-footer .columns{
    padding-left: 15px;
  }
  .copyright{
    padding-left: 15px;
  }
    .journal-header-mega #logo a, .breadcrumb{
      padding-left:15px;
  }
}


header .links > a{
  border-bottom-color:#e4e4e4;
}

.journal-header-default .links .no-link,
.journal-header-menu .links .no-link{
    border-color:rgb(228, 228, 228)}

.journal-header-center #cart .content:before,
.oc2 #cart .content .cart-wrapper:before{
  color:rgb(255, 255, 255)}

.journal-header-center .autocomplete2-suggestions:before{
  color:rgb(255, 255, 255)}


.journal-language .dropdown-menu:before,
.journal-currency .dropdown-menu:before{
  color:rgb(255, 255, 255)}

.journal-header-center .journal-language form > div,
.journal-header-center .journal-currency form > div{
  border-left-style:solid;
  border-right-style:solid;
}

#search ::-webkit-input-placeholder {
  color:rgb(51, 55, 69);
  font-family: inherit;
}
#search :-moz-placeholder {
  color:rgb(51, 55, 69);
  font-family: inherit;
}
#search ::-moz-placeholder {
  color:rgb(51, 55, 69);
  font-family: inherit;
}
#search :-ms-input-placeholder {
  color:rgb(51, 55, 69);
  font-family: inherit;
}

.button-search{
    border-right-style:solid;
}
.button-search{
    border-right-color:rgb(51, 55, 69);
}
header .journal-login{
    border-bottom-color:rgb(51, 55, 69);
}


.super-menu > li:last-of-type{
    border-right-color:rgb(95, 104, 116);
    border-right-style:dotted;
}

@media only screen and (max-width: 760px) {
  .journal-header-center #search input,
  .journal-header-center .button-search{
      border-radius:0;
  }
  .journal-header-center #search input{
      background-color:rgb(244, 244, 244);
  }
  .journal-header-center #cart{
      background-color:rgb(244, 244, 244);
  }

  header .journal-login{
      border-bottom-style:solid;
  }

  .journal-menu .mobile-menu > li{
    border-bottom-color:rgb(95, 104, 116);
    border-bottom-style:dotted;
  }
}

.inline-button .product-details{
  padding-bottom:0;
}

  .product-grid-item .cart{
  display:inline-block !important;
  }








.product-info .right .options.push-1 .option-image li.selected span img{
  border-color:;
}

.mega-menu-categories .mega-menu-item,
.mega-menu-brands .mega-menu-item,
.mega-menu-html .mega-menu-item,
#header .mega-menu .product-grid-item{
  margin-bottom:15px;
}
.mega-menu > div{
  margin-bottom:-15px;
  margin-right:-15px;
}

.mega-menu .mega-menu-column:last-of-type > div{
   margin-right:-15px;
}

.mega-menu-column > div > h3, .mega-menu .mega-menu-column .menu-cms-block{
  margin-right:15px;
}
.mega-menu .mega-menu-column:last-of-type > h3,
.mega-menu .mega-menu-column:last-of-type > div > h3,
.mega-menu .mega-menu-column:last-of-type > .menu-cms-block,
.mega-menu .mega-menu-column.mega-menu-html-block > div{
  margin-right:0;
}

@media only screen and (max-width: 760px) {
  .mega-menu .mega-menu-column > div{
   margin-right:-15px;
  }
}

.journal-sf .sf-image .box-content ul{
  margin-bottom:-5px;
  margin-right:-5px;
}

















.has-cta .rotator-tex{
  line-height:px;
}

footer .contacts .hint--top:before{
  border-top-color: rgb(235, 88, 88);
}


.side-column .box-category,
.side-column .box-content,
.side-column .box-content > div,
.side-column .box-content > ul > li:last-of-type,
.side-column .oc-module .product-grid-item:last-of-type{
  border-bottom-left-radius: inherit;
  border-bottom-right-radius: inherit;
  border-radius:inherit;
}


.journal-sf ul li label:hover{
  color:rgb(235, 88, 88);
}
.sf-icon:before{
  border-top-color:rgb(51, 55, 69);
}

/*
.journal-sf ul li label:hover img{
  border-color:rgb(69, 115, 143);
} */

.sf-price .value:after{
  border-bottom-color:rgb(51, 55, 69);
}

.mobile-trigger{
background-color:rgb(51, 55, 69);
}


.journal-header-default .links > a,
.journal-header-menu .links > a{
  border-bottom-color: transparent;
}

@media only screen and (max-width: 760px) {
.journal-header-default .links > a,
.journal-header-menu .links > a{
  border-bottom-color: rgb(228, 228, 228);
}
}
.nav-numbers a:hover,
.nav-numbers li.active a{
  -webkit-backface-visibility: hidden;
  -webkit-transform: scale(1.2);
  -moz-transform: scale(1.2);
  -ms-transform: scale(1.2);
  transform: scale(1.2);
}
.headline-mode .nav-numbers a:hover,
.headline-mode .nav-numbers li.active a{
  -webkit-backface-visibility: hidden;
  -webkit-transform: scale();
  -moz-transform: scale();
  -ms-transform: scale();
  transform: scale();
}
.tp-bullets.simplebullets.round .bullet.selected,
.tp-bullets.simplebullets.round .bullet:hover,
.journal-simple-slider .owl-controls .owl-page.active span,
.journal-simple-slider .owl-controls.clickable .owl-page:hover span{
  -webkit-backface-visibility: hidden;
  -webkit-transform: scale(1.5);
  -moz-transform: scale(1.5);
  -ms-transform: scale(1.5);
  transform: scale(1.5);
}

.owl-controls .owl-page.active span,
.owl-controls.clickable .owl-page:hover span{
  -webkit-transform: scale(1.2);
  -moz-transform: scale(1.2);
  -ms-transform: scale(1.2);
  transform: scale(1.2);
}

@media only screen and (max-width: 1295px) {

.bottom-footer.fullwidth-bar .copyright{
  padding-left: 15px;
}
.bottom-footer.fullwidth-bar .payments{
  padding-right: 15px;
}
.extended-layout #column-left{
  padding:20px 0 0 20px;
}
.extended-layout #column-right{
  padding:20px 20px 0 0;
}
.extended-layout #content,
.extended-layout #column-left + #content,
.extended-layout #column-right + #content,
.extended-layout #column-left + #column-right + #content{
  padding:20px 20px 0 20px;
}
.journal-simple-slider{
  height: auto !important;
}
.extended-layout #column-left{
  width:240px;
}

.extended-layout #column-right{
  width:240px;
}
.extended-layout #column-left + #content{
  margin-left:240px;
}
.extended-layout #column-right + #content{
  margin-right:240px;
}
.extended-layout #column-left + #column-right + #content{
margin-left:240px;
margin-right:240px;
}
}

@media only screen and (max-width: 980px) {
.journal-header-default .mega-menu,
.journal-header-menu .mega-menu{
    width: 100%;
  }
}

@media only screen and (max-width: 760px) {
  .extended-layout #column-left + #content,
  .extended-layout #column-right + #content,
  .extended-layout #column-left + #column-right + #content{
    margin-left:0;
    margin-right:0;
  }
   .journal-header-center .journal-secondary{
  background-color:rgb(235, 88, 88);
}

}

.mega-menu{
  max-width:1280px;
  /* margin-top:0px; */
}

/*
.mega-menu > div > div:first-child .wishlist .hint--top:after{
  left:53px;
}
*/






.extended-container #container{
  background-color:transparent;
}




.product-grid-item.display-icon .wishlist-icon:before,
.product-grid-item.display-icon .compare-icon:before{
  line-height:25px;
}

.journal-header-center #cart .heading i{
  height:39px;
}

.journal-desktop .menu-floated .float-left{
  border-right-style:dotted;
}

.column.products > h3{
  margin-bottom:6px;
}
.column.products{
  padding-bottom:6px;
}

.side-column .journal-gallery .box-heading{
  margin-bottom:0px;
}

.side-column .box-category > ul li ul li a{
  padding-left: 17px;
}
.side-column .box-category > ul li ul li ul li a{
  padding-left: 24px;
}
.side-column .box-category > ul li ul li ul li ul li a{
  padding-left: 31px;
}
.side-column .box-category > ul li ul li ul li ul li ul li a{
  padding-left: 38px;
}
.side-column .box-category > ul li ul li ul li ul li ul li ul li a{
  padding-left: 45px;
}

@media only screen and (max-width: 1295px) {
  .breadcrumb{
    padding-left:10px;
  }
}


.custom-sections .box-heading.box-sections{
    border-left-style:solid;
}




.posts.blog-list-view .post-item-details{
    width: 70%;
}


.side-column .box.cms-blocks .box-heading{
  margin-bottom:1px;
}

@media only screen and (min-width: 1295px) {
  .safari5 #footer,
  .safari5.boxed-header header{
     width: 1280px;
  }
}

@media only screen and (max-width: 1295px) {
  .tp-banner-container{
    height:auto !important;
  }
}

@media only screen and (max-width: 1295px) {
#top-modules>div, #bottom-modules>div{
  padding-left:20px;
  padding-right:20px;
}
.checkout-page #content {
  padding-left: 20px;
  padding-right: 20px;
}
}


.product-grid-item:hover .countdown,
.product-list-item:hover .countdown {
    opacity: 1;
    visibility: visible;
}




.option li.hint--top:before{
  border-top-color:;
}


/* Custom CSS */

</style>
<div class="col-lg-12 col-sm-12 col-md-12">
    <div class="journal-checkout">
        <div class="left">

            <div class="checkout-content login-box">
                <h2 class="secondary-title">Crea nueva cuenta o logueate</h2>
                <div class="radio">
                    <label>
                        <input type="radio" name="account" value="register" class='register' checked="checked" data-smartlook_2fecb6293ed16="true">
                        Registrar Cuenta                            </label>
                    </div>

                    <div class="radio">
                        <label>
                            <input type="radio" name="account" value="login" class='login' data-smartlook_2fecb6293ed16="false">
                            Ya es Cliente                            </label>
                        </div>
                    </div>


                    <div class="checkout-content checkout-login" style="">
                        <fieldset>
                            <h2 class="secondary-title">Ya es Cliente</h2>
                            <div class="form-group">
                                <label class="control-label" for="input-login_email">E-Mail</label>
                                <input type="text" name="login_email" value="" placeholder="E-Mail" id="input-login_email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="input-login_password">Contraseña</label>
                                <input type="password" name="login_password" value="" placeholder="Contraseña" id="input-login_password" class="form-control">
                                <a href="https://mercadosale.com/index.php?route=account/forgotten">Olvidó su contraseña</a>
                            </div>
                            <div class="form-group">
                                <input type="button" value="Iniciar sesión" id="button-login" data-loading-text="Cargando..." class="btn-primary button">
                            </div>
                        </fieldset>
                    </div>

                    <div class="checkout-content checkout-register">
                        <fieldset id="account">
                            <h2 class="secondary-title">Datos Personales</h2>

                            <div class="form-group customer-group" style="display: none;">
                                <label class="control-label">Tipo de Cliente</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="customer_group_id" value="1" checked="checked" data-smartlook_2fecb6293ed16="true">
                                        Default</label>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="control-label" for="input-payment-firstname">Nombre</label>
                                    <input type="text" name="firstname" value="" placeholder="Nombre" id="input-payment-firstname" class="form-control">
                                </div>
                                <div class="form-group required">
                                    <label class="control-label" for="input-payment-lastname">Apellido</label>
                                    <input type="text" name="lastname" value="" placeholder="Apellido" id="input-payment-lastname" class="form-control">
                                </div>
                                <div class="form-group required">
                                    <label class="control-label" for="input-payment-email">E-Mail</label>
                                    <input type="text" name="email" value="" placeholder="E-Mail" id="input-payment-email" class="form-control">
                                </div>
                                <div class="form-group required">
                                    <label class="control-label" for="input-payment-telephone">Teléfono</label>
                                    <input type="text" name="telephone" value="" placeholder="Teléfono" id="input-payment-telephone" class="form-control">
                                </div>
                                <div class="form-group fax-input">
                                    <label class="control-label" for="input-payment-fax">Fax</label>
                                    <input type="text" name="fax" value="" placeholder="Fax" id="input-payment-fax" class="form-control">
                                </div>
                            </fieldset>
                            <fieldset id="password" style="">
                                <h2 class="secondary-title">Contraseña</h2>

                                <div class="form-group required">
                                    <label class="control-label" for="input-payment-password">Contraseña</label>
                                    <input type="password" name="password" value="" placeholder="Contraseña" id="input-payment-password" class="form-control">
                                </div>
                                <div class="form-group required">
                                    <label class="control-label" for="input-payment-confirm">Confirmar Contraseña</label>
                                    <input type="password" name="confirm" value="" placeholder="Confirmar Contraseña" id="input-payment-confirm" class="form-control">
                                </div>
                            </fieldset>

                            <fieldset id="shipping-address" >
                                <h2 class="secondary-title">Shipping Address</h2>
                                <div class=" checkout-shipping-form">
                                    <form class="form-horizontal form-shipping">
                                        <div id="shipping-new" style="display: block;">
                                            <div class="form-group required">
                                                <label class="col-sm-2 control-label" for="input-shipping-firstname">Nombre</label>

                                                <input type="text" name="shipping_firstname" value="" placeholder="Nombre" id="input-shipping-firstname" class="form-control">
                                            </div>
                                            <div class="form-group required">
                                                <label class="col-sm-2 control-label" for="input-shipping-lastname">Apellido</label>

                                                <input type="text" name="shipping_lastname" value="" placeholder="Apellido" id="input-shipping-lastname" class="form-control">
                                            </div>
                                            <div class="form-group company-input">
                                                <label class="col-sm-2 control-label" for="input-shipping-company">Facturar a</label>

                                                <input type="text" name="shipping_company" value="" placeholder="Facturar a" id="input-shipping-company" class="form-control">
                                            </div>
                                            <div class="form-group required">
                                                <label class="col-sm-2 control-label" for="input-shipping-address-1">Calle</label>

                                                <input type="text" name="shipping_address_1" value="" placeholder="Calle" id="input-shipping-address-1" class="form-control">
                                            </div>
                                            <div class="form-group address-2-input">
                                                <label class="col-sm-2 control-label" for="input-shipping-address-2">Colonia</label>

                                                <input type="text" name="shipping_address_2" value="" placeholder="Colonia" id="input-shipping-address-2" class="form-control">
                                            </div>
                                            <div class="form-group required">
                                                <label class="col-sm-2 control-label" for="input-shipping-city">Ciudad</label>

                                                <input type="text" name="shipping_city" value="" placeholder="Ciudad" id="input-shipping-city" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-shipping-postcode">Código Postal</label>

                                                <input type="text" name="shipping_postcode" value="" placeholder="Código Postal" id="input-shipping-postcode" class="form-control">
                                            </div>
                                            <div class="form-group required">
                                                <label class="col-sm-2 control-label" for="input-shipping-country">País</label>
                                                <div class="col-sm-10">

                                                    <select name="shipping_country_id" id="input-shipping-country" class="form-control">
                                                        <option value="138" selected="selected">Mexico</option>
                                                    </select> 
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                                <label class="col-sm-2 control-label" for="input-shipping-zone">Region / Provincia</label>
                                                <div class="col-sm-10">

                                                    <select name="shipping_zone_id" id="input-shipping-zone" class="form-control"><option value=""> --- Selecciona --- </option><option value="3971">Aguascalientes</option><option value="2146">Baja California Norte</option><option value="2147">Baja California Sur</option><option value="2148">Campeche</option><option value="2149">Chiapas</option><option value="2150">Chihuahua</option><option value="2151">Coahuila de Zaragoza</option><option value="2152">Colima</option><option value="2153">Distrito Federal</option><option value="2154">Durango</option><option value="2155">Guanajuato</option><option value="2156">Guerrero</option><option value="2157">Hidalgo</option><option value="2158">Jalisco</option><option value="2159">Mexico</option><option value="2160">Michoacan de Ocampo</option><option value="2161">Morelos</option><option value="2162">Nayarit</option><option value="2163" selected="selected">Nuevo Leon</option><option value="2164">Oaxaca</option><option value="2165">Puebla</option><option value="2166">Queretaro de Arteaga</option><option value="2167">Quintana Roo</option><option value="2168">San Luis Potosi</option><option value="2169">Sinaloa</option><option value="2170">Sonora</option><option value="2171">Tabasco</option><option value="2172">Tamaulipas</option><option value="2173">Tlaxcala</option><option value="2174">Veracruz-Llave</option><option value="2175">Yucatan</option><option value="2176">Zacatecas</option></select>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>    </fieldset>

                            </div>                                    </div>
                            <div class="right">
                                <section class="section-left">
                                    <div class="spw">

                                        <div class="checkout-content checkout-payment-methods">
                                            <h2 class="secondary-title">Metodo de pago</h2>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="payment_method" value="cod" checked="checked" data-smartlook_2fecb6293ed16="true">
                                                    Cash On Delivery                            </label>
                                                </div>
                                            </div>                        </div>
                                        </section>
                                        <section class="section-right">
                                            <div class="checkout-content checkout-cart">
                                                <h2 class="secondary-title">Carrito de Compra</h2>
                                                <div class="table-responsive checkout-product">
                                                    <table class="table table-bordered table-hover">

                                                        <thead>
                                                            <tr>
                                                                <td class="text-left name" colspan="2">Nombre del Producto</td>
                                                                <td class="text-left quantity">Cantidad</td>
                                                                <td class="text-right price">Precio Unitario</td>
                                                                <td class="text-right total">Total</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="text-center image">                            <a href="https://mercadosale.com/index.php?route=product/product&amp;product_id=186"><img src="image/cache/articles/AC-456010-1-47x47.jpg" alt="VIDEO BALUM CON EXTENSION PARA 200MTS PROVISION, HD PTR-101V-HD" title="VIDEO BALUM CON EXTENSION PARA 200MTS PROVISION, HD PTR-101V-HD" class="img-thumbnail"></a>
                                                                </td>
                                                                <td class="text-left name"><a href="https://mercadosale.com/index.php?route=product/product&amp;product_id=186">VIDEO BALUM CON EXTENSION PARA 200MTS PROVISION, HD PTR-101V-HD</a>
                                                                </td>
                                                                <td class="text-left quantity">
                                                                    <div class="input-group btn-block" style="max-width: 200px;">
                                                                        <input type="text" name="quantity[11]" value="1" size="1" class="form-control">
                                                                        <span class="input-group-btn">
                                                                            <button type="submit" data-toggle="tooltip" title="" data-product-key="11" class="btn btn-primary btn-update" data-original-title="Actualizar"><i class="fa fa-refresh"></i></button>
                                                                            <button type="button" data-toggle="tooltip" title="" data-product-key="11" class="btn btn-danger  btn-delete" data-original-title="Eliminar"><i class="fa fa-times-circle"></i></button>
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td class="text-right price">$130.00</td>
                                                                <td class="text-right total">$130.00</td>
                                                            </tr>
                                                        </tbody>
                                                        <tfoot>

                                                            <tr>
                                                                <td colspan="4" class="text-right">Sub-Total:</td>
                                                                <td class="text-right">$130.00</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" class="text-right">Total:</td>
                                                                <td class="text-right">$130.00</td>
                                                            </tr>
                                                        </tfoot>

                                                    </table>
                                                </div>
                                                <div id="payment-confirm-button" class="payment-cod">
                                                    <h2 class="secondary-title">Payment Details</h2>
                                                    <div class="buttons">
                                                        <div class="pull-right">
                                                            <input type="button" value="Confirmar compra" id="button-confirm" class="btn btn-primary" data-loading-text="Cargando...">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>



                                            <div class="checkout-content confirm-section">
                                                <div>
                                                    <h2 class="secondary-title">Añadir Comentarios Sobre Su Pedido</h2>
                                                    <label>
                                                        <textarea name="comment" rows="8" class="form-control"></textarea>
                                                    </label>
                                                </div>
                                                <div class="checkbox check-newsletter">
                                                    <label for="newsletter">
                                                        <input type="checkbox" name="newsletter" value="1" id="newsletter" data-smartlook_2fecb6293ed16="false">
                                                        Deseo suscribirme al boletín de noticias MercadoSale .                                </label>
                                                    </div>

                                                    <div class="radio check-privacy">
                                                        <label>
                                                            <input type="checkbox" name="privacy" value="1" data-smartlook_2fecb6293ed16="false">
                                                            He leído y estoy de acuerdo con la <a href="https://mercadosale.com/index.php?route=information/information/agree&amp;information_id=3" class="agree"><b>Privacy Policy</b></a>                                </label>
                                                        </div>

                                                        <div class="radio check-terms">
                                                            <label>
                                                                <input type="checkbox" name="agree" value="1" data-smartlook_2fecb6293ed16="false">
                                                                He leído y estoy de acuerdo con la <a href="https://mercadosale.com/index.php?route=information/information/agree&amp;information_id=5" class="agree"><b>Terms &amp; Conditions</b></a>                                </label>
                                                            </div>
                                                            <div class="confirm-order">
                                                                <button id="journal-checkout-confirm-button" data-loading-text="Loading.." class="button confirm-button">Confirm Order</button>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </div>
                                            </div>
                                        </div>

<script type="text/javascript">
$(document).on("click","div.login-box > div.radio > label > input.register",function(){
// if ($('input.checkbox_check').is(':checked')) {
    $("div.checkout-register").show();
// }
});
$(document).on("click","div.login-box > div.radio > label > input.login",function(){
    $("div.checkout-register").hide();
});
</script>