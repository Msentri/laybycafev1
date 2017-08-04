<section class="page-section" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
    <div class="container">
        <div class="row">
            <h1>Dashboard
                <a data-remodal-target="pay-now-modal" class="btn btn-default">Pay now</a>
            </h1>
        </div>
        <!-- ####################################################### -->

        <?php require 'functions/pay_now_function.php'; ?>

        <!-- ####################################################### -->
        <div class="row">
            <div class="col-lg-12">
                <ul class="nav  nav-tabs ">
                    <li class="active">
                        <a href="#tab1" data-toggle="tab">
                            <i class="livicon" data-name="user" data-size="16" data-c="#000" data-hc="#000" data-loop="true"></i>
                            Current Layby's</a>
                    </li>
                    <li>
                        <a href="#tab2" data-toggle="tab">
                            <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                            Awaiting Deposit</a>
                    </li>
                    <li>
                        <a href="#tab3" data-toggle="tab">
                            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                            Cancelled</a>
                    </li>
                    <li>
                        <a href="#tab4" data-toggle="tab">
                            <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                            Completed</a>
                    </li>
                </ul>
                <div  class="tab-content mar-top">
                    <div id="tab1" class="tab-pane fade active in">
                        <div class="row">
                            <div class="col-md-12 pd-top">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Store</th>
                                        <th>Order Number</th>
                                        <th>Monthly Installment</th>
                                        <th>Next Payment</th>
                                        <th>Total Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                            include 'functions/viewConsumer_dashboard.php'
                                            ?>
                                    </tbody>
                                </table>
                                <div class="col-md-4" align="left">
                                    <!-- Title And Content -->
                                    <span class="text-color"></span>
                                    <?php
                                        $link = 'dashboard?page=%d';
                                        $pagerContainer = '<div style="width: 300px;">';
                                    if( $totalPages != 0 )
                                    {
                                    if( $page == 1 )
                                    {
                                    $pagerContainer .= '';
                                    }
                                    else
                                    {
                                    $pagerContainer .= sprintf( '<a href="' . $link . '" style="color: #c00"> &#171; prev page</a>', $page - 1 );
                                    }
                                    $pagerContainer .= ' <span> page <strong>' . $page . '</strong> from ' . $totalPages . '</span>';
                                    if( $page == $totalPages )
                                    {
                                    $pagerContainer .= '';
                                    }
                                    else
                                    {
                                    $pagerContainer .= sprintf( '<a href="' . $link . '" style="color: #c00"> next page &#187; </a>', $page + 1 );
                                    }
                                    }
                                    $pagerContainer .= '</div>';

                                echo $pagerContainer;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab2" class="tab-pane fade">
                    <div class="row">
                        <div class="col-md-12 pd-top">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Store</th>
                                    <th>Order Number</th>
                                    <th>Deposit</th>
                                    <th>Total Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    include 'functions/viewConsumerAwaitingDep.php'
                                ?>
                                </tbody>
                            </table>
                            <div class="col-md-4" align="left">
                                <!-- Title And Content -->
                                <span class="text-color"></span>
                                <?php
                                        $link = 'dashboard?page=%d';


                                        $pagerContainer = '<div style="width: 300px;">';
                                if( $totalPages != 0 )
                                {
                                if( $page == 1 )
                                {
                                $pagerContainer .= '';
                                }
                                else
                                {
                                $pagerContainer .= sprintf( '<a href="' . $link . '" style="color: #c00"> &#171; prev page</a>', $page - 1 );
                                }
                                $pagerContainer .= ' <span> page <strong>' . $page . '</strong> from ' . $totalPages . '</span>';
                                if( $page == $totalPages )
                                {
                                $pagerContainer .= '';
                                }
                                else
                                {
                                $pagerContainer .= sprintf( '<a href="' . $link . '" style="color: #c00"> next page &#187; </a>', $page + 1 );
                                }
                                }
                                $pagerContainer .= '</div>';

                            echo $pagerContainer;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tab3" class="tab-pane fade">
                <div class="row">
                    <div class="col-md-12 pd-top">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Store</th>
                                <th>Order Number</th>
                                <th>Monthly Installment</th>
                                <th>Total Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                            include 'functions/viewConsumerCancelledDep.php'
                                            ?>
                            </tbody>
                        </table>
                        <div class="col-md-4" align="left">
                            <!-- Title And Content -->
                            <span class="text-color"></span>
                            <?php
                                        $link = 'dashboard?page=%d';
                                        $pagerContainer = '<div style="width: 300px;">';
                            if( $totalPages != 0 )
                            {
                            if( $page == 1 )
                            {
                            $pagerContainer .= '';
                            }
                            else
                            {
                            $pagerContainer .= sprintf( '<a href="' . $link . '" style="color: #c00"> &#171; prev page</a>', $page - 1 );
                            }
                            $pagerContainer .= ' <span> page <strong>' . $page . '</strong> from ' . $totalPages . '</span>';
                            if( $page == $totalPages )
                            {
                            $pagerContainer .= '';
                            }
                            else
                            {
                            $pagerContainer .= sprintf( '<a href="' . $link . '" style="color: #c00"> next page &#187; </a>', $page + 1 );
                            }
                            }
                            $pagerContainer .= '</div>';

                        echo $pagerContainer;
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="tab4" class="tab-pane fade">
            <div class="row">
                <div class="col-md-12 pd-top">
                    <div class="col-md-12 pd-top">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Store</th>
                                <th>Order Number</th>
                                <th>Collection Code</th>
                                <th>Total Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                                include 'functions/viewConsumerCompletedDep.php'
                                                ?>
                            </tbody>
                        </table>
                        <div class="col-md-4" align="left">
                            <!-- Title And Content -->
                            <span class="text-color"></span>
                            <?php
                                            $link = 'dashboard?page=%d';
                                            $pagerContainer = '<div style="width: 300px;">';
                            if( $totalPages != 0 )
                            {
                            if( $page == 1 )
                            {
                            $pagerContainer .= '';
                            }
                            else
                            {
                            $pagerContainer .= sprintf( '<a href="' . $link . '" style="color: #c00"> &#171; prev page</a>', $page - 1 );
                            }
                            $pagerContainer .= ' <span> page <strong>' . $page . '</strong> from ' . $totalPages . '</span>';
                            if( $page == $totalPages )
                            {
                            $pagerContainer .= '';
                            }
                            else
                            {
                            $pagerContainer .= sprintf( '<a href="' . $link . '" style="color: #c00"> next page &#187; </a>', $page + 1 );
                            }
                            }
                            $pagerContainer .= '</div>';

                        echo $pagerContainer;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
</section>