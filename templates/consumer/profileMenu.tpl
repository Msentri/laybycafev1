<?php
if(@$_GET['tab'] == null){
?>
<li class="active">
    <a href="#tab1" data-toggle="tab">
        <i class="livicon" data-name="user" data-size="16" data-c="#000" data-hc="#000" data-loop="true"></i>
        Consumer Profile</a>
</li>
<li>
    <a href="#tab2" data-toggle="tab">
        <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
        Change Password
    </a>
</li>
<li>
    <a href="#tab3" data-toggle="tab">
        <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
        Update Details</a>
</li>
<li>
    <a href="#tab4" data-toggle="tab">
        <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
        Bank and Wallet</a>
</li>
<?php
    //Gets tab 2//
}
elseif(@$_GET['tab']==2){

  ?>
<li >
    <a href="#tab1" data-toggle="tab">
        <i class="livicon" data-name="user" data-size="16" data-c="#000" data-hc="#000" data-loop="true"></i>
        Consumer Profile</a>
</li>
<li class="active">
    <a href="#tab2" data-toggle="tab">
        <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
        Change Password
    </a>
</li>
<li>
    <a href="#tab3" data-toggle="tab">
        <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
        Update Details</a>
</li>
<li>
    <a href="#tab4" data-toggle="tab">
        <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
        Bank and Wallet</a>
</li>
<?php
    //Gets tab 3//
}elseif(@$_GET['tab']==3){
    ?>
<li >
    <a href="#tab1" data-toggle="tab">
        <i class="livicon" data-name="user" data-size="16" data-c="#000" data-hc="#000" data-loop="true"></i>
        Consumer Profile</a>
</li>
<li>
    <a href="#tab2" data-toggle="tab">
        <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
        Change Password
    </a>
</li>
<li  class="active">
    <a href="#tab3" data-toggle="tab">
        <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
        Update Details</a>
</li>
<li>
    <a href="#tab4" data-toggle="tab">
        <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
        Bank and Wallet</a>
</li>
<?php
}elseif(@$_GET['tab']==4){
?>
<li >
    <a href="#tab1" data-toggle="tab">
        <i class="livicon" data-name="user" data-size="16" data-c="#000" data-hc="#000" data-loop="true"></i>
        Consumer Profile</a>
</li>
<li>
    <a href="#tab2" data-toggle="tab">
        <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
        Change Password
    </a>
</li>
<li >
    <a href="#tab3" data-toggle="tab">
        <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
        Update Details</a>
</li>
<li class="active">
    <a href="#tab4" data-toggle="tab">
        <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
        Bank and Wallet</a>
</li>
<?php
}
?>