<?php
require __DIR__ . '/vendor/atelierdisko/coupon_code/src/CouponCode.php';

use CouponCode\CouponCode;

$code = new CouponCode();

$result = $code->generate();
// returns a string in `XXXX-XXXX-XXXX` format i.e.
// `1K7Q-CTFM-LMTC`.

$code->validate($result);
// returns a boolean indicating if the code is valid.

$rst = $code->normalize('i9oD_V467-8Dsz');
// returns `190D-V467-8D52`

var_dump($rst);