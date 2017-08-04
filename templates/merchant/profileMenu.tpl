<?php
if(@$_GET['tab'] == null){
    ?>
<ul class="nav  nav-tabs ">

    <li class="active">
        <a href="#tab1" data-toggle="tab">
            <i class="livicon" data-name="user" data-size="16" data-c="#000" data-hc="#000" data-loop="true"></i>
            Merchant Profile</a>
    </li>

    <li><?php 	if(@$verifiedAccount == "Y") {
            ?>
        <a href="#tab2" data-toggle="tab">
            <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Change Password
        </a>
    </li><?php }?>
    <li>
        <a href="#tab3" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Business Details</a>
    </li>
    <?php

        if(@$verifiedAccount == "Y")
        {

            echo'
                        <li>
    <a href="#tab4" data-toggle="tab">
        <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
        Bank and Wallet</a>
    </li>

    ';} ?>
    <li>
        <a href="#tab5" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Merchant Documents</a>
    </li>

    <li>
        <a href="#tab6" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Notifications</a>
    </li>
    <li>
        <a href="#tab7" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Online Store</a>
    </li>
    <li>
        <a href="#tab8" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Branches</a>
    </li>
    <li>
        <a href="#tab9" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Users</a>
    </li>
    <li>
        <a href="#tab10" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            API Details</a>
    </li>
</ul>
<?php
    //Gets tab 2//
}

elseif(@$_GET['tab']==2){

    ?>
<ul class="nav  nav-tabs ">

    <li>
        <a href="#tab1" data-toggle="tab">
            <i class="livicon" data-name="user" data-size="16" data-c="#000" data-hc="#000" data-loop="true"></i>
            Merchant Profile</a>
    </li>

    <li  class="active"><?php 	if(@$verifiedAccount == "Y") {
            ?>
        <a href="#tab2" data-toggle="tab">
            <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Change Password
        </a>
    </li><?php }?>
    <li>
        <a href="#tab3" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Business Details</a>
    </li>
    <?php

        if(@$verifiedAccount == "Y")
        {

            echo'
                        <li>
    <a href="#tab4" data-toggle="tab">
        <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
        Bank and Wallet</a>
    </li>

    ';} ?>
    <li>
        <a href="#tab5" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Merchant Documents</a>
    </li>

    <li>
        <a href="#tab6" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Notifications</a>
    </li>
    <li>
        <a href="#tab7" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Online Store</a>
    </li>
    <li>
        <a href="#tab8" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Branches</a>
    </li>
    <li>
        <a href="#tab9" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Users</a>
    </li>
    <li>
        <a href="#tab10" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            API Details</a>
    </li>
</ul>
<?php
    //Gets tab 3//
}
elseif(@$_GET['tab']==3){
    ?>
<ul class="nav  nav-tabs ">

    <li>
        <a href="#tab1" data-toggle="tab">
            <i class="livicon" data-name="user" data-size="16" data-c="#000" data-hc="#000" data-loop="true"></i>
            Merchant Profile</a>
    </li>

    <li><?php 	if(@$verifiedAccount == "Y") {
            ?>
        <a href="#tab2" data-toggle="tab">
            <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Change Password
        </a>
    </li><?php }?>
    <li class="active">
        <a href="#tab3" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Business Details</a>
    </li>
    <?php

        if(@$verifiedAccount == "Y")
        {

            echo'
                        <li>
    <a href="#tab4" data-toggle="tab">
        <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
        Bank and Wallet</a>
    </li>

    ';} ?>
    <li>
        <a href="#tab5" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Merchant Documents</a>
    </li>

    <li>
        <a href="#tab6" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Notifications</a>
    </li>
    <li>
        <a href="#tab7" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Online Store</a>
    </li>
    <li>
        <a href="#tab8" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Branches</a>
    </li>
    <li>
        <a href="#tab9" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Users</a>
    </li>
    <li>
        <a href="#tab10" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            API Details</a>
    </li>
</ul>
<?php
}
elseif(@$_GET['tab']==4){
    ?>
<ul class="nav  nav-tabs ">

    <li>
        <a href="#tab1" data-toggle="tab">
            <i class="livicon" data-name="user" data-size="16" data-c="#000" data-hc="#000" data-loop="true"></i>
            Merchant Profile</a>
    </li>

    <li><?php 	if(@$verifiedAccount == "Y") {
            ?>
        <a href="#tab2" data-toggle="tab">
            <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Change Password
        </a>
    </li><?php }?>
    <li>
        <a href="#tab3" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Business Details</a>
    </li>
    <?php

        if(@$verifiedAccount == "Y")
        {

            echo'
                        <li class="active">
    <a href="#tab4" data-toggle="tab">
        <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
        Bank and Wallet</a>
    </li>

    ';} ?>
    <li>
        <a href="#tab5" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Merchant Documents</a>
    </li>

    <li>
        <a href="#tab6" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Notifications</a>
    </li>
    <li>
        <a href="#tab7" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Online Store</a>
    </li>
    <li>
        <a href="#tab8" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Branches</a>
    </li>
    <li>
        <a href="#tab9" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Users</a>
    </li>
    <li>
        <a href="#tab10" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            API Details</a>
    </li>
</ul>
<?php
}

elseif(@$_GET['tab']==5){
    ?>
<ul class="nav  nav-tabs ">

    <li>
        <a href="#tab1" data-toggle="tab">
            <i class="livicon" data-name="user" data-size="16" data-c="#000" data-hc="#000" data-loop="true"></i>
            Merchant Profile</a>
    </li>

    <li><?php 	if(@$verifiedAccount == "Y") {
            ?>
        <a href="#tab2" data-toggle="tab">
            <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Change Password
        </a>
    </li><?php }?>
    <li>
        <a href="#tab3" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Business Details</a>
    </li>
    <?php

        if(@$verifiedAccount == "Y")
        {

            echo'
                        <li>
    <a href="#tab4" data-toggle="tab">
        <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
        Bank and Wallet</a>
    </li>

    ';} ?>
    <li class="active">
        <a href="#tab5" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Merchant Documents</a>
    </li>

    <li>
        <a href="#tab6" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Notifications</a>
    </li>
    <li>
        <a href="#tab7" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Online Store</a>
    </li>
    <li>
        <a href="#tab8" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Branches</a>
    </li>
    <li>
        <a href="#tab9" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Users</a>
    </li>
    <li>
        <a href="#tab10" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            API Details</a>
    </li>
</ul>
<?php
}
elseif(@$_GET['tab']==6){
    ?>
<ul class="nav  nav-tabs ">

    <li>
        <a href="#tab1" data-toggle="tab">
            <i class="livicon" data-name="user" data-size="16" data-c="#000" data-hc="#000" data-loop="true"></i>
            Merchant Profile</a>
    </li>

    <li><?php 	if(@$verifiedAccount == "Y") {
            ?>
        <a href="#tab2" data-toggle="tab">
            <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Change Password
        </a>
    </li><?php }?>
    <li>
        <a href="#tab3" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Business Details</a>
    </li>
    <?php

        if(@$verifiedAccount == "Y")
        {

            echo'
                        <li>
    <a href="#tab4" data-toggle="tab">
        <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
        Bank and Wallet</a>
    </li>

    ';} ?>
    <li>
        <a href="#tab5" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Merchant Documents</a>
    </li>

    <li  class="active">
        <a href="#tab6" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Notifications</a>
    </li>
    <li>
        <a href="#tab7" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Online Store</a>
    </li>
    <li>
        <a href="#tab8" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Branches</a>
    </li>
    <li>
        <a href="#tab9" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Users</a>
    </li>
    <li>
        <a href="#tab10" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            API Details</a>
    </li>
</ul>
<?php
}
elseif(@$_GET['tab']==7){
    ?>
<ul class="nav  nav-tabs ">

    <li>
        <a href="#tab1" data-toggle="tab">
            <i class="livicon" data-name="user" data-size="16" data-c="#000" data-hc="#000" data-loop="true"></i>
            Merchant Profile</a>
    </li>

    <li><?php 	if(@$verifiedAccount == "Y") {
            ?>
        <a href="#tab2" data-toggle="tab">
            <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Change Password
        </a>
    </li><?php }?>
    <li>
        <a href="#tab3" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Business Details</a>
    </li>
    <?php

        if(@$verifiedAccount == "Y")
        {

            echo'
                        <li>
    <a href="#tab4" data-toggle="tab">
        <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
        Bank and Wallet</a>
    </li>

    ';} ?>
    <li>
        <a href="#tab5" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Merchant Documents</a>
    </li>

    <li>
        <a href="#tab6" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Notifications</a>
    </li>
    <li class="active">
        <a href="#tab7" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Online Store</a>
    </li>
    <li>
        <a href="#tab8" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Branches</a>
    </li>
    <li>
        <a href="#tab9" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Users</a>
    </li>
    <li>
        <a href="#tab10" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            API Details</a>
    </li>
</ul>
<?php
}
elseif(@$_GET['tab']==8){
    ?>
<ul class="nav  nav-tabs ">

    <li>
        <a href="#tab1" data-toggle="tab">
            <i class="livicon" data-name="user" data-size="16" data-c="#000" data-hc="#000" data-loop="true"></i>
            Merchant Profile</a>
    </li>

    <li><?php 	if(@$verifiedAccount == "Y") {
            ?>
        <a href="#tab2" data-toggle="tab">
            <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Change Password
        </a>
    </li><?php }?>
    <li>
        <a href="#tab3" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Business Details</a>
    </li>
    <?php

        if(@$verifiedAccount == "Y")
        {

            echo'
                        <li>
    <a href="#tab4" data-toggle="tab">
        <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
        Bank and Wallet</a>
    </li>

    ';} ?>
    <li>
        <a href="#tab5" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Merchant Documents</a>
    </li>

    <li>
        <a href="#tab6" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Notifications</a>
    </li>
    <li>
        <a href="#tab7" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Online Store</a>
    </li>
    <li class="active">
        <a href="#tab8" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Branches</a>
    </li>
    <li>
        <a href="#tab9" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Users</a>
    </li>
    <li>
        <a href="#tab10" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            API Details</a>
    </li>
</ul>
<?php
}
elseif(@$_GET['tab']==9){
    ?>
<ul class="nav  nav-tabs ">

    <li>
        <a href="#tab1" data-toggle="tab">
            <i class="livicon" data-name="user" data-size="16" data-c="#000" data-hc="#000" data-loop="true"></i>
            Merchant Profile</a>
    </li>

    <li><?php 	if(@$verifiedAccount == "Y") {
            ?>
        <a href="#tab2" data-toggle="tab">
            <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Change Password
        </a>
    </li><?php }?>
    <li>
        <a href="#tab3" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Business Details</a>
    </li>
    <?php

        if(@$verifiedAccount == "Y")
        {

            echo'
                        <li>
    <a href="#tab4" data-toggle="tab">
        <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
        Bank and Wallet</a>
    </li>

    ';} ?>
    <li>
        <a href="#tab5" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Merchant Documents</a>
    </li>

    <li>
        <a href="#tab6" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Notifications</a>
    </li>
    <li>
        <a href="#tab7" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Online Store</a>
    </li>
    <li>
        <a href="#tab8" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Branches</a>
    </li>
    <li class="active">
        <a href="#tab9" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Users</a>
    </li>
    <li>
        <a href="#tab10" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            API Details</a>
    </li>
</ul>
<?php
}
elseif(@$_GET['tab']==10){
    ?>
<ul class="nav  nav-tabs ">

    <li>
        <a href="#tab1" data-toggle="tab">
            <i class="livicon" data-name="user" data-size="16" data-c="#000" data-hc="#000" data-loop="true"></i>
            Merchant Profile</a>
    </li>

    <li><?php 	if(@$verifiedAccount == "Y") {
            ?>
        <a href="#tab2" data-toggle="tab">
            <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Change Password
        </a>
    </li><?php }?>
    <li>
        <a href="#tab3" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Business Details</a>
    </li>
    <?php
        if(@$verifiedAccount == "Y")
        {
            echo'
                        <li>
    <a href="#tab4" data-toggle="tab">
        <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
        Bank and Wallet</a>
    </li>

    ';} ?>
    <li>
        <a href="#tab5" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Merchant Documents</a>
    </li>

    <li>
        <a href="#tab6" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Notifications</a>
    </li>
    <li>
        <a href="#tab7" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Online Store</a>
    </li>
    <li>
        <a href="#tab8" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Branches</a>
    </li>
    <li>
        <a href="#tab9" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            Users</a>
    </li>
    <li class="active">
        <a href="#tab10" data-toggle="tab">
            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
            API Details</a>
    </li>
</ul>
<?php
}
?>