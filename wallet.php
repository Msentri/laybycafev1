<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/09/07
 * Time: 12:14 PM
 */

include 'header.php';

?>



<section class="page-section" xmlns="http://www.w3.org/1999/html">
    <div class="remodal-bg">
        <div class="container">
            <div class="row">
                <h1>Wallet</h1>
            </div>
            <div class="row">

                <table class="table">
                    <caption></caption>
                    <thead>
                    <tr>
                        <th>Description</th>
                        <th>Transaction Type</th>
                        <th>Amount</th>
                        <th>Balance</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <?php
                    include 'functions/walletLog.php';

                    ?>
                    </tr>


<tr>
    <td><a href="profile?tab=4" class="btn btn-default btn-lg">Pay Out</a></td>
</tr>

                    </tbody>

                </table>
 <div class="col-md-4" align="left">
                                    <!-- Title And Content -->
                                    <span class="text-color"></span>
                                    <?php
									$link = 'wallet?page=%d';
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
                <hr /></p>
                <!-- Features 3 -->
            </div>
            <p>&nbsp;</p>
        </div>
    </div>
</section>


<?php
require_once 'footer.php';
?>
</body>
</html>