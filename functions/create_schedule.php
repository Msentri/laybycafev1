<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/09/05
 * Time: 11:43 AM
 */

$merchant = $_SESSION['userSession'];

if(isset($_POST['createSchedule']))

                    {

                        //Sends info to the script bellow
                        $payoutFrequency = $_POST['payout_frequency'];
                        $minAmount = $_POST['min_amount'];

                        if($payoutFrequency=='Daily'){

                            $payoutDate = $db->now('+1d');
                        }

                        if($payoutFrequency=='Weekly'){

                            $payoutDate = $db->now('+7d');
                        }

                        if($payoutFrequency=='Fortnightly'){

                            $payoutDate = $db->now('+14d');
                        }

                        if($payoutFrequency=='Monthly'){

                            $payoutDate = $db->now('+1M');
                        }



                            $data = Array (
                                'merchant_id' => $merchant,
                                'payout_frequency' => $payoutFrequency,
                                'min_amount' => $minAmount,
                                'payout_date' => $payoutDate,
                                'lastSchedule' => $db->now(),
                            );


                            $id = $db->insert ('payout_schedule', $data);


            }



?>