<section class="page-section">
    <div class="row">
        <div class="container">

            <div class="row">

                <h1>Dashboard</h1>

            </div>
            <br/>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div  class="container who-we-are pad-60">
                            <div class="row">
                                <div class="col-md-4 animated fadeInRight visible" data-animation="fadeInRight">
                                    <h5 class="no-margin">Search Transactions</h5>
                                    <p><strong>View all transactions <span class="text-color">per customer!</span></strong></p>
                                </div>
                                <form autocomplete="off" method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
                                    <div class="col-md-8 animated fadeInLeft visible" data-animation="fadeInLeft">
                                        <div class="input-group domain-search" id="Domain-search">
                                            <input name="search" type="text" class="form-control" placeholder="Search by ID number, Email, Ref Number or Cell Number...">
                                            <div class="input-group-btn">
                                                <div class="btn-group" role="group">

                                                    <button type="submit" name="searchLayby" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                                </div></form>
                            </div>
                        </div>

                    </div></div></div></div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="nav  nav-tabs ">
                    <li class="active">
                        <a href="#tab1" data-toggle="tab">
                            <i class="livicon" data-name="user" data-size="16" data-c="#000" data-hc="#000" data-loop="true"></i>
                            Processing</a>
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
                                        <th>Ref No.</th>
                                        <th>Item</th>
                                        <th>Balance</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                        include 'functions/viewBranch_dashboard.php'
                                        ?>
                                    </tbody>
                                </table>
                                <div class="col-md-4" align="left">
                                    <!-- Title And Content -->
                                    <span class="text-color"></span>
                                    <?php
                                        $link = 'dashboard?page=%d';
                                        $pagerContainer = '<div style="width: 300px;">';
                                    if( @$totalPages != 0 )
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
                                    <th>Ref No.</th>
                                    <th>Item</th>
                                    <th>Balance</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <?php
                                            include 'functions/viewBranch_awaitingDep.php'
                                            ?>

                                </tr>
                                </tbody>
                            </table>
                            <div class="col-md-4" align="left">
                                <!-- Title And Content -->
                                <span class="text-color"></span>
                                <?php
                                        $link = 'dashboard?page=%d';
                                        $pagerContainer = '<div style="width: 300px;">';
                                if( @$totalPages != 0 )
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
                                <th>Ref No.</th>
                                <th>Item</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <?php
                                            include 'functions/viewBranch_cancelled.php'
                                            ?>

                            </tr>
                            </tbody>
                        </table>
                        <div class="col-md-4" align="left">
                            <!-- Title And Content -->
                            <span class="text-color"></span>
                            <?php
                                        $link = 'dashboard?page=%d';
                                        $pagerContainer = '<div style="width: 300px;">';
                            if( @$totalPages != 0 )
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
                                <th>Ref No.</th>
                                <th>Item</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <?php
                                                include 'functions/viewBranch_completed.php'
                                                ?>

                            </tr>
                            </tbody>
                        </table>
                        <div class="col-md-4" align="left">
                            <!-- Title And Content -->
                            <span class="text-color"></span>
                            <?php
                                            $link = 'dashboard?page=%d';
                                            $pagerContainer = '<div style="width: 300px;">';
                            if( @$totalPages != 0 )
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
</section>