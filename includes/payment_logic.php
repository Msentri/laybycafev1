<?php
//Payment Processing Logic//

//installment of 2 months
if($period=='2 Months' and $price >= '220' and $price < '550'){

    $deposit = round(@$price * 0.5);

    $amount = round ($price - $deposit);
    $instalment = round ($amount/1);
    $months = "1 months";
    $amount = round ($deposit + $instalment*1);
}
elseif($period=='2 Months' and $price > '549' and $price < '1000'){

    $deposit = round(@$price * 0.5);

    $amount = round ($price - $deposit);
    $instalment = round ($amount/1);
    $months = "1 months";
    $amount = round ($deposit + $instalment*1);
}

elseif($period=='2 Months' and $price >'999' and $price < '4999'){

    $deposit = round(@$price * 0.5);

    $amount = round ($price - $deposit);
    $instalment = round ($amount/1);
    $months = "1 months";
    $amount = round ($deposit + $instalment*1);
}

elseif($period=='2 Months' and $price >= '5000'){

    $deposit = round(@$price * 0.5);

    $amount = round ($price - $deposit);
    $instalment = round ($amount/1);
    $months = "1 months";
    $amount = round ($deposit + $instalment*1);
}

//installment for 3 months

if($period=='3 Months' and $price >= '220' and $price < '550'){

    $deposit = round(@$price * 0.5);

    $amount = round ($price - $deposit);
    $instalment = round ($amount/1);
    $months = "1 months";
    $amount = round ($deposit + $instalment*1);
}
elseif($period=='3 Months' and $price > '549' and $price < '1000'){

    $deposit = round(@$price * 0.2);

    $amount = round ($price - $deposit);
    $instalment = round ($amount/2);
    $months = "2 months";
    $amount = round ($deposit + $instalment*1);
}

elseif($period=='3 Months' and $price >'999' and $price < '4999'){

    $deposit = round(@$price * 0.15);

    $amount = round ($price - $deposit);
    $instalment = round ($amount/2);
    $months = "2 months";
    $amount = round ($deposit + $instalment*1);
}

elseif($period=='3 Months' and $price >= '5001'){

    $deposit = round(@$price * 0.1);

    $amount = round ($price - $deposit);
    $instalment = round ($amount/2);
    $months = "2 months";
    $amount = round ($deposit + $instalment*1);
}

//installment for 6 months

if($period=='6 Months' and $price >= '220' and $price < '550'){

    $deposit = round(@$price * 0.5);

    $amount = round ($price - $deposit);
    $instalment = round ($amount/1);
    $months = "1 months";
    $amount = round ($deposit + $instalment*1);
}

elseif($period=='6 Months' and $price > '549' and $price < '1000'){

    $deposit = round(@$price * 0.2);

    $amount = round ($price - $deposit);
    $instalment = round ($amount/2);
    $months = "2 months";
    $amount = round ($deposit + $instalment*1);
}

elseif($period=='6 Months' and $price >'999' and $price < '4999'){

    $deposit = round(@$price * 0.15);

    $amount = round ($price - $deposit);
    $instalment = round ($amount/5);
    $months = "5 months";
    $amount = round ($deposit + $instalment*1);
}

elseif($period=='6 Months' and $price >= '5001'){

    $deposit = round(@$price * 0.1);

    $amount = round ($price - $deposit);
    $instalment = round ($amount/5);
    $months = "5 months";
    $amount = round ($deposit + $instalment*1);
}

//installment for 9 months

if($period=='9 Months' and $price >= '220' and $price < '550'){

    $deposit = round(@$price * 0.5);

    $amount = round ($price - $deposit);
    $instalment = round ($amount/1);
    $months = "1 months";
    $amount = round ($deposit + $instalment*1);
}

elseif($period=='9 Months' and $price > '549' and $price < '1000'){

    $deposit = round(@$price * 0.2);

    $amount = round ($price - $deposit);
    $instalment = round ($amount/2);
    $months = "2 months";
    $amount = round ($deposit + $instalment*1);
}

elseif($period=='9 Months' and $price >'999' and $price < '4999'){

    $deposit = round(@$price * 0.15);

    $amount = round ($price - $deposit);
    $instalment = round ($amount/8);
    $months = "8 months";
    $amount = round ($deposit + $instalment*1);
}

elseif($period=='9 Months' and $price >= '5001'){

    $deposit = round(@$price * 0.1);

    $amount = round ($price - $deposit);
    $instalment = round ($amount/8);
    $months = "8 months";
    $amount = round ($deposit + $instalment*1);
}


//installment for 12 months

if($period=='12 Months' and $price >= '220' and $price < '550'){

    $deposit = round(@$price * 0.5);

    $amount = round ($price - $deposit);
    $instalment = round ($amount/1);
    $months = "1 months";
    $amount = round ($deposit + $instalment*1);
}

elseif($period=='12 Months' and $price > '549' and $price < '1000'){

    $deposit = round(@$price * 0.2);

    $amount = round ($price - $deposit);
    $instalment = round ($amount/2);
    $months = "2 months";
    $amount = round ($deposit + $instalment*1);
}

elseif($period=='12 Months' and $price >'999' and $price < '4999'){

    $deposit = round(@$price * 0.15);
    $amount = round ($price - $deposit);
    $instalment = round ($amount/11);
    $months = "11 months";
    $amount = round ($deposit + $instalment*1);
}

elseif($period=='12 Months' and $price >= '5001'){

    $deposit = round(@$price * 0.1);

    $amount = round ($price - $deposit);
    $instalment = round ($amount/11);
    $months = "11 months";
    $amount = round ($deposit + $instalment*1);
}
?>