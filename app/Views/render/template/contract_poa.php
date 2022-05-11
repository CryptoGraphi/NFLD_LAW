<?php


function parseProvince($province)
{
    $provinceName = [
        'Ontario', 'Quebec', 'Nova Scotia', 'New Brunswick', 'Manitoba', 'British Columbia',
        'Prince Edward Island', 'Saskatchewan', 'Alberta', 'NewFoundland and Labrador'
    ];
    $provinceValue = ['ON', 'QC', 'NS', 'NB', 'MB', 'BC', 'PE', 'SK', 'AB', 'NL'];

    for ($i = 0; $i < count($provinceName); $i++) {
        if ($provinceValue[$i] === $province) {
            return $provinceName[$i];
        }
    }
    return false;
}


// index counter varibles

$mainPageCounter = 0;


?>

<div id='container_object'>
    <div data='generate'>

        <p style="line-height:18.0pt;font-size:12.0pt;line-height:18.0pt;font-family:Times New Roman;color:#000000;text-align:Center;">
            <span style="font-style:normal;font-weight:bold;">
                <?php

                echo $document['type'] === "ordinary" ? "POWER OF ATTORNEY" : "ENDURING POWER OF ATTORNEY";

                ?>

            </span>
        </p>
        <p style="line-height:18.0pt;font-size:12.0pt;line-height:18.0pt;font-family:Times New Roman;color:#000000;text-align:Left;">
            <span style="font-style:normal;font-weight:bold;">THIS <?php echo $document['type'] === "ordinary" ? "POWER OF ATTORNEY" : "ENDURING POWER OF ATTORNEY"; ?></span> is given by me,
            <?php echo $person['name']; ?>,
            presently of <?php echo $person['address']; ?>, on the <?php echo date('l jS \of F Y'); ?>
        </p>
        <ol start="1" style="line-height:18.0pt;font-size:12.0pt;line-height:18.0pt;font-family:Times New Roman;color:#000000;list-style:decimal;">
            <?php
            if ($document['type'] === 'enduring') {
                echo '<li class="lh" style="text-align:Left;list-style:none;"><span style="font-style:normal;font-weight:bold;text-decoration:underline;">Nature of Power</span><span style="color:#000000;"><br></span>
                </li>';

                echo '<li style="margin-bottom:18.0pt;" value='.++$mainPageCounter.'><span>THIS IS AN ENDURING POWER OF ATTORNEY and the authority of my Attorney shall not terminate if I become disabled or incapacitated or in the event of later uncertainty as to whether I am dead or alive.</span><span style="color:#000000;"><br></span>
                </li>';


                echo '<li class="lh" style="text-align:Left;list-style:none;"><span style="font-style:normal;font-weight:bold;text-decoration:underline;">Effective Date</span><span style="color:#000000;"><br></span>
                </li>';

                echo '<li style="margin-bottom:18.0pt;" value='.++$mainPageCounter.'><span>This Power of Attorney will not come into effect unless and until:</span><span style="color:#000000;"><br></span>
                <ol start="1" style="list-style:lower-alpha;">
                    <li style="margin-bottom:18.0pt;"><span>I am infirm, physically incapable of handling my financial affairs or mentally incapable of making reasonable judgments in respect of matters relating to all or any part of my estate; or</span><span style="color:#000000;"><br></span>
                    </li>
                    <li style="margin-bottom:0.0pt;"><span>I declare in writing that it is my wish that this Power of Attorney come into effect.</span><span style="color:#000000;"><br></span>
                    </li>
                </ol>
            </li>';


                echo '<li class="lh" style="text-align:Left;list-style:none;"><span style="font-style:normal;font-weight:bold;text-decoration:underline;">Determination of Incapacity</span><span style="color:#000000;"><br></span>
            <li style="margin-bottom:18.0pt;" value='.++$mainPageCounter.'><span>This Power of Attorney will not come into effect unless and until:</span><span style="color:#000000;"><br></span>
                <ol start="1" style="list-style:lower-alpha;">
                    <li style="margin-bottom:18.0pt;" value="1"><span>I am infirm, physically incapable of handling my financial affairs or mentally incapable of making reasonable judgments in respect of matters relating to all or any part of my estate; or</span><span style="color:#000000;"><br></span>
                    </li>
                    <li style="margin-bottom:0.0pt;" value="2"><span>I declare in writing that it is my wish that this Power of Attorney come into effect.</span><span style="color:#000000;"><br></span>
                    </li>
                </ol>
            </li></li>';


                echo '<li style="margin-bottom:18.0pt;"><span>THE WRITTEN DECLARATION of one (1) medical doctor licensed to practice in the Province of ' . parseProvince($document['province']) . ' that I am no longer capable of making reasonable judgments in respect of matters relating to all or any part of my estate will be conclusive proof of my infirmity or mental incapacity and that the Power of Attorney associated with this event shall become effective. If I am located outside of ' . parseProvince($document['province']) . ', then the written declaration of one (1) medical doctors licensed to practice in that jurisdiction will be conclusive proof of my infirmity or mental incapacity. In either case my Attorney will have the authority to choose the physicians.</span><span style="color:#000000;"><br></span>
            </li>';
            }

            ?>

            <li class="lh" style="text-align:Left;list-style:none;"><span style="font-style:normal;font-weight:bold;text-decoration:underline;">Previous Power of
                    Attorney</span><span style="color:#000000;"><br></span>
            </li>
            <li value='<?php echo ++$mainPageCounter ?>' style="margin-bottom:18.0pt;"><span style="font-style:normal;font-weight:bold;">I
                    REVOKE</span> any previous power of attorney granted by me.<span style="color:#000000;"><br></span>
            </li>
            <li class="lh" style="text-align:Left;list-style:none;"><span style="font-style:normal;font-weight:bold;text-decoration:underline;">Attorney</span><span style="color:#000000;"><br></span>
            </li>
            <li style="margin-bottom:18.0pt;"  value='<?php  echo ++$mainPageCounter; ?>'><span style="font-style:normal;font-weight:bold;">I APPOINT
                </span><?php echo $attorney['name'];  ?>, of , <?php echo  $attorney['address'];  ?> to act as my
                Attorney.<span style="color:#000000;"><br></span>
            </li>
            <li class="lh" style="text-align:Left;list-style:none;"><span style="font-style:normal;font-weight:bold;text-decoration:underline;">Alternate
                    Attorney</span><span style="color:#000000;"><br></span>
            </li>
            <li style="margin-bottom:18.0pt;"  value='<?php echo ++$mainPageCounter;  ?>'><span>On the death, refusal or inability of
                    <?php echo $attorney['name']; ?> to act
                    or continue to act, </span><span style="font-style:normal;font-weight:bold;">I APPOINT
                </span><?php echo $altAttorney['name'];  ?>, of <?php echo $altAttorney['address']; ?> to act as my
                alternate Attorney.<span style="color:#000000;"><br></span>
            </li>
            <li class="lh" style="text-align:Left;list-style:none;"><span style="font-style:normal;font-weight:bold;text-decoration:underline;">'My Attorney'</span><span style="color:#000000;"><br></span>
            </li>
            <li value='<?php  echo ++$mainPageCounter; ?>'style="margin-bottom:18.0pt;"><span>I will refer to my Attorney and my alternate Attorney
                    as 'my Attorney'.</span><span style="color:#000000;"><br></span>
            </li>
            <li class="lh"  style="text-align:Left;list-style:none;"><span style="font-style:normal;font-weight:bold;text-decoration:underline;">Governing
                    Legislation</span><span style="color:#000000;"><br></span>
            </li>
            <li style="margin-bottom:18.0pt;"  value='<?php  echo ++$mainPageCounter; ?>'><span>My Attorney will act in accordance with the
                </span><span style="font-style:italic;font-weight:normal;">Powers of Attorney Act</span> of the
                Province of <?php echo parseProvince($document['province']) ?>, as may be amended from time to
                time.<span style="color:#000000;"><br></span>
            </li>
            <li class="lh" style="text-align:Left;list-style:none;"><span style="font-style:normal;font-weight:bold;text-decoration:underline;">Powers of
                    Attorney</span><span style="color:#000000;"><br></span>
            </li>

            <?php

            if ($powers['generalAuthority'] == true) {

                echo '   <li style="margin-bottom:18.0pt;" value=' .++$mainPageCounter .'><span>My Attorney has authority to do anything on my behalf
                                that I may lawfully do by an attorney (the "general power").</span></li>';
            } else {
                // display the list of the powers

                echo '<li style="margin-bottom:18.0pt;" value='.++$mainPageCounter.'><span>My Attorney will have only the following  power(s):</span><span style="color:#000000;"><br></span>';
                echo '<ol style="list-style:lower-alpha;">';

                echo "<br/>";

                if ($powers['realestate'] === 'on') {
                    echo '
                    <li class="lh" style="text-align:Left;margin-bottom:18.0pt;list-style:none;"><span
                            style="font-style:normal;font-weight:bold;">Real Estate Matters</span><span
                            style="color:#000000;"><br></span>
                    </li>
                    <li style="margin-bottom:18.0pt;"><span>To sign all documents on my behalf concerning
                            lands which are capable of registration under land titles legislation, real property
                            legislation, and registry legislation or such other similar legislation of all the provinces
                            and territories of Canada and any foreign jurisdiction. This power includes the ability to
                            purchase, sell, rent, mortgage, charge, exchange, lease, surrender, manage or otherwise deal
                            with real estate and any interest therein, and execute and deliver deeds, transfers,
                            mortgages, charges, leases, assignments, surrenders, releases and other instruments required
                            for any such purpose;</span><span style="color:#000000;"><br></span>
                    </li>';
                }
                if ($powers['homeExpenses'] === 'on') {

                    echo ' 
                    <li class="lh" style="text-align:Left;margin-bottom:18.0pt;list-style:none;"><span
                            style="font-style:normal;font-weight:bold;">Stay at Home Requirement</span><span
                            style="color:#000000;"><br></span>
                    </li>
                    <li style="margin-bottom:18.0pt;"><span>To make whatever expenditures are necessary,
                            including home renovations, to allow me, my spouse and any dependent children to remain in
                            our own home for as long as my Attorney deems advisable, having regard to all of the
                            circumstances, including the size of my estate and the income requirements of me, my spouse
                            and dependent children;</span><span style="color:#000000;"><br></span>
                    </li>';
                } else if ($powers['familyExpenses'] === 'on') {
                    echo '  <li class="lh" style="text-align:Left;margin-bottom:18.0pt;list-style:none;"><span
                    style="font-style:normal;font-weight:bold;">Family Care</span><span
                    style="color:#000000;"><br></span>
            </li>
            <li style="margin-bottom:18.0pt;"><span>To make whatever expenditures are required for the
                    maintenance, education, benefit, medical care and general advancement of me, my spouse and
                    dependent children, and other persons that I have chosen or which I am legally required to
                    support, any of which may include my Attorney. This power includes, but is not limited to,
                    the power to pay for housing, clothing, food, travel and other living costs;</span><span
                    style="color:#000000;"><br></span>
            </li>';
                }
                if ($powers['taxMatters'] === 'on') {

                    echo '
                    <li class="lh" style="text-align:Left;margin-bottom:18.0pt;list-style:none;"><span
                            style="font-style:normal;font-weight:bold;">Tax Matters</span><span
                            style="color:#000000;"><br></span>
                    </li>
                    <li style="margin-bottom:18.0pt;"><span>To act for me to prepare, sign, and file documents
                            with any governmental body or agency, including, but not limited to, authority
                            to:</span><span style="color:#000000;"><br></span>
                        <ol start="1" style="list-style:lower-roman;">
                            <li style="margin-bottom:18.0pt;" value="1"><span>prepare, sign and file income and other
                                    tax returns with federal, provincial, local and other governmental bodies;
                                    and</span><span style="color:#000000;"><br></span>
                            </li>
                            <li style="margin-bottom:0.0pt;"><span>obtain information or documents from any
                                    government or its agencies, and represent me in all tax matters, including the
                                    authority to negotiate, compromise, or settle any matter with such government or
                                    agency.</span><span style="color:#000000;"><br></span>
                            </li>
                        </ol>
                    </li>';
                }
                if ($powers['familyGifts'] === 'on') {

                    echo '     <li class="lh" style="text-align:Left;margin-bottom:18.0pt;list-style:none;"><span
                    style="font-style:normal;font-weight:bold;">Gift Transactions</span><span
                    style="color:#000000;"><br></span>
            </li>
            <li style="margin-bottom:18.0pt;" ><span>To make gifts to my spouse, children,
                    grandchildren, great grandchildren, and other family members on special occasions, including
                    birthdays and seasonal holidays, including cash gifts, and to such other persons with whom I
                    have an established pattern of giving (or if it is appropriate to make such gifts for estate
                    planning and/or tax purposes), in such amounts as my Attorney may decide in his or her
                    absolute discretion, having regard to all of the circumstances, including the gifts I made
                    while I was capable of managing my own estate, the size of my estate and my income
                    requirements;</span><span style="color:#000000;"><br></span></li>';
                }

                if ($powers['chairityGifts'] === 'on') {

                    echo '   <li class="lh" style="text-align:Left;margin-bottom:18.0pt;list-style:none;"><span
                    style="font-style:normal;font-weight:bold;">Charity Transactions</span><span
                    style="color:#000000;"><br></span>
            </li>
            <li style="margin-bottom:18.0pt;" ><span>To continue to make gifts to charitable
                    organizations with whom I have an established pattern of giving (or if it is appropriate to
                    make such gifts for estate planning and/or tax purposes), in such amounts as my Attorney may
                    decide in his or her absolute discretion, having regard to all of the circumstances,
                    including the gifts I made while I was capable of managing my own estate, the size of my
                    estate and my income requirements;</span><span style="color:#000000;"><br></span>
            </li>';
                }


                if ($powers['businessInvestments'] === 'on') {

                    echo '   <li class="lh" style="text-align:Left;margin-bottom:18.0pt;list-style:none;"><span
                    style="font-style:normal;font-weight:bold;">Maintain Property and Make
                    Investments</span><span style="color:#000000;"><br></span>
            </li>
            <li style="margin-bottom:18.0pt;" ><span>To retain any assets owned by me at the date this
                    Ordinarypower of attorney becomes effective, and the power to reinvest those assets in
                    similar investments. In addition, my Attorney may invest my assets in any new investments,
                    of his or her choosing, regardless of whether or not they are authorized by any applicable
                    legislation;</span><span style="color:#000000;"><br></span></li>';
                }

                if ($powers['stocks'] === 'on') {

                    echo '       <li class="lh" style="text-align:Left;margin-bottom:18.0pt;list-style:none;"><span
                    style="font-style:normal;font-weight:bold;">Manage Corporate Shares</span><span
                    style="color:#000000;"><br></span>
            </li>
            <li style="margin-bottom:18.0pt;" ><span>To vote any shares (the "Shares") owned by me in
                    any corporation (the "Corporations") as my proxy at any and all general meetings of those
                    Corporations, including annual and extraordinary, which may be held and at every adjournment
                    thereof and at every poll which may take place in consequence thereof;</span><span
                    style="color:#000000;"><br></span>
                <ol start="1" style="list-style:lower-roman;">
                    <li style="margin-bottom:0.0pt;" value="1"><span>The authority to vote the Shares will
                            include, but not be limited to, replacing myself with my Attorney as sole director
                            of the Corporations in order to run the Corporations.</span><span
                            style="color:#000000;"><br></span>
                    </li>
                </ol>
            </li>
            <li class="lh" style="text-align:Left;margin-bottom:18.0pt;list-style:none;"><span
                    style="font-style:normal;font-weight:bold;">Sell Corporate Shares</span><span
                    style="color:#000000;"><br></span>
            </li>
            <li style="margin-bottom:18.0pt;" ><span>To sell the Shares or any assets of the
                    Corporations; and</span><span style="color:#000000;"><br></span>
            </li>';
                }

                if ($powers['employProfessionals'] === 'on') {
                    echo '
                    <li class="lh" style="text-align:Left;margin-bottom:18.0pt;list-style:none;"><span
                            style="font-style:normal;font-weight:bold;">Employ any Required Professionals</span><span
                            style="color:#000000;"><br></span>
                    </li>
                    <li style="margin-bottom:0.0pt;"><span>To appoint and employ any agents, servants,
                            companions, or other persons, including nurses, for my care and/or the care of my spouse and
                            dependant children at such compensation and for such length of time as my Attorney considers
                            advisable.</span><span style="color:#000000;"><br></span>
                    </li>';
                }


                if ($limited['propertySale'] === 'on') {
                    echo '<br/><li class="lh" style="text-align:Left;margin-bottom:18.0pt;list-style:none;"><span style="font-style:normal;font-weight:bold;">Real Estate Sale</span><span style="color:#000000;"><br></span>
                        </li>';

                    echo '<li style="margin-bottom:18.0pt;"><span>To negotiate and complete all matters for the preparation and execution of relevant and related documents concerning the sale of premises owned by me and located at _____________________________________________________, and municipally known as _____________________________________________________;</span><span style="color:#000000;"><br></span>
                        </li>';
                }


                if ($limited['propertyPurchase'] === 'on') {
                    echo '<li class="lh" style="text-align:Left;margin-bottom:18.0pt;list-style:none;"><span style="font-style:normal;font-weight:bold;">Real Estate Purchase</span><span style="color:#000000;"><br></span>
                        </li>';

                    echo '<li style="margin-bottom:18.0pt;"><span>To negotiate and complete all matters for the preparation and execution of relevant and related documents concerning the purchase of premises located at _____________________________________________________, and municipally known as _____________________________________________________;</span><span style="color:#000000;"><br></span> </li>';
                }


                if ($limited['propertyPaymentCollection'] === 'on') {
                    echo '<li class="lh" style="text-align:Left;margin-bottom:18.0pt;list-style:none;"><span style="font-style:normal;font-weight:bold;">Manage Real Estate</span><span style="color:#000000;"><br></span>
                        </li>';

                    echo '<li style="margin-bottom:18.0pt;"><span>To manage the property owned by me, or in which I have an interest, located at _____________________________________________________, and municipally known as _____________________________________________________. This power includes, but is not limited to, the power to receive rents, make repairs, pay expenses including the insuring of the property and generally to deal with my property as effectually as I myself could do; to take all lawful proceedings by way of action or otherwise, for recovery of rent in arrears, or for eviction of tenants; and to commence, carry on and defend all actions, suits and other proceedings touching my property or any part of it; and</span><span style="color:#000000;"><br></span>
                        </li>';
                }


                if ($limited['bankAccount'] === 'on') {
                    echo '<li class="lh" style="text-align:Left;margin-bottom:18.0pt;list-style:none;"><span style="font-style:normal;font-weight:bold;">Manage Specific Financial Account</span><span style="color:#000000;"><br></span>
                        </li>';

                    echo '<li style="margin-bottom:0.0pt;"><span>To control my accounts with ____________________________________ (Bank),<br>located at _________________________________________,<br>Account Number(s)__________________________________________.<br><br>This power includes the authority to conduct any business with respect to any of my listed accounts, including, but not limited to, making deposits and withdrawals, negotiating or endorsing any cheques or other instruments with respect to any such accounts, obtaining bank statements, passbooks, drafts, money orders, warrants, and certificates or vouchers payable to me by any person, firm, corporation or political entity, and to perform any act necessary to deposit, negotiate, sell or transfer any note, security or draft.</span><span style="color:#000000;"><br></span>
                        </li>';
                }

                echo '</ol></li>';
            }



            ?>

            <span style="color:#000000;"><br></span>

            <li class="lh" style="text-align:Left;list-style:none;"><span style="font-style:normal;font-weight:bold;text-decoration:underline;">Attorney
                    Compensation</span><span style="color:#000000;"><br></span>
            </li>
            <li style="margin-bottom:18.0pt;" value='<?php  echo ++$mainPageCounter; ?>'><span>My Attorney will receive compensation as per the
                    guidelines governing the compensation for agents or trustees or other such legislated rate in
                    the <?php echo  parseProvince($document['province']);  ?> in addition to the reimbursement of all
                    out of pocket expenses associated with the
                    carrying out my wishes. If no guidelines or usual practices exist for the compensation of an
                    attorney then my Attorney may pay himself or herself a reasonable amount based on the size of my
                    estate.</span><span style="color:#000000;"><br></span>
            </li>
            <li class="lh" style="text-align:Left;list-style:none;"><span style="font-style:normal;font-weight:bold;text-decoration:underline;">Co-owning of Assets and
                    Mixing of Funds</span><span style="color:#000000;"><br></span>
            </li>
            <li style="margin-bottom:18.0pt;" value='<?php  echo ++$mainPageCounter; ?>'><span>My Attorney may not mix any funds owned by him or her
                    in with my funds and all assets should remain separately owned if at all possible.</span><span style="color:#000000;"><br></span>
            </li>
            <li class="lh" style="text-align:Left;list-style:none;"><span style="font-style:normal;font-weight:bold;text-decoration:underline;">Personal Gain from
                    Managing My Affairs</span><span style="color:#000000;"><br></span>
            </li>
            <li style="margin-bottom:18.0pt;" value='<?php  echo ++$mainPageCounter; ?>'><span>My Attorney is not allowed to personally gain from any
                    transaction he or she may complete on my behalf.</span><span style="color:#000000;"><br></span>
            </li>

            <?php
            if ($financialReports['sendReports'] == 1) {
                echo '  <li class="lh" style="text-align:Left;list-style:none;"><span
                    style="font-style:normal;font-weight:bold;text-decoration:underline;">Reporting
                    Requirements</span><span style="color:#000000;"><br></span>
            </li>';


                echo '<li style="margin-bottom:18.0pt;" value='. ++$mainPageCounter.'><span>My Attorney is required to prepare financial reports
            , starting ' . $financialReports['frequency'] . ' following the determination of my incapacity, detailing
            income, expenses, and any change in the value of assets over the previous ' . $financialReports['frequency'] . ' period. These
            reports will be sent within one month of the due date to:</span><br><br>' . $financialReports['name'] . ',  ' . $financialReports['address']  . '<span
            style="color:#000000;"><br></span>    </li>';
            }

            ?>


            <?php

            if ($attorneyTermination['specifyDate'] == 1) {
                echo '<li class="lh" style="text-align:Left;list-style:none;"><span style="font-style:normal;font-weight:bold;text-decoration:underline;">Termination of Power of attorney</span><span style="color:#000000;"><br></span>
                    </li>';

                echo '<li style="margin-bottom:18.0pt;"  value='.++$mainPageCounter.'><span>This power of attorney will cease to be in effect at 11:59 PM, local time on the ' . date('l jS \of F Y', strtotime($attorneyTermination['date'])) . '</span><span style="color:#000000;"><br></span>
                    </li>';
            }

            ?>

<?php

            if ($document['type'] === 'ordinary')  {
                echo '
                <li class="lh" style="text-align:Left;list-style:none;"><span style="font-style:normal;font-weight:bold;text-decoration:underline;">Effective Date</span><span style="color:#000000;"><br></span>
                </li>';


                echo '
                <li style="margin-bottom:18.0pt;" value='. ++$mainPageCounter. '><span>This power of attorney will start immediately upon
                        signing. Under no circumstances will the powers granted in this power of attorney continue after
                        my mental incapacity or death.</span><span style="color:#000000;"><br></span>
                </li>';

            }
?>



            <li class="lh" style="text-align:Left;list-style:none;"><span style="font-style:normal;font-weight:bold;text-decoration:underline;">Attorney
                    Restrictions</span><span style="color:#000000;"><br></span>
            </li>
            <li style="margin-bottom:18.0pt;" value='<?php  echo ++$mainPageCounter; ?>'><span>This Power of Attorney is subject to each of the
                    following conditions or restrictions:</span><span style="color:#000000;"><br></span>
                <ol start="1" style="list-style:lower-alpha;">

                    <?php

                    if ($restrictions['setRestrictions'] == 0) {

                        echo '<li style="margin-bottom:18.0pt;"><span>This power of attorney is not subject to any conditions or restrictions other than those noted above.</span><span style="color:#000000;"><br></span>
                        </li>';
                    }

                    if ($restrictions['setRestrictions'] == 1) {
                        if ($restrictions['independent'] === 'on') {
                            echo '    <li style="margin-bottom:0.0pt;"><span>My Attorney must make whatever expenditures are
                            necessary to allow me, my spouse and any dependent children to remain in our own home
                            for as long as my Attorney deems advisable, having regard to all the circumstances,
                            including the size of my estate and the income requirements of me, my spouse and
                            dependent children</span><span style="color:#000000;"><br></span>
                             </li>';
                        }

                        if ($restrictions['investments'] === 'on') {
                            echo '<li style="margin-bottom:0.0pt;"><span>I restrict the types of investments my Attorney can make with my money to investments in only government issued savings bonds</span><span style="color:#000000;"><br></span>
                            </li>';
                        }
                    }

                    ?>

                </ol>
            </li>
            <li class="lh" style="text-align:Left;list-style:none;"><span style="font-style:normal;font-weight:bold;text-decoration:underline;">Severability</span><span style="color:#000000;"><br></span>
            </li>
            <li style="margin-bottom:18.0pt;" value='<?php  echo ++$mainPageCounter; ?>'><span>If any part of any provision of this instrument is
                    ruled invalid or unenforceable under applicable law, such part will be ineffective to the extent
                    of such invalidity only, without in any way affecting the remaining parts of such provisions or
                    the remaining provisions of this instrument.</span><span style="color:#000000;"><br></span>
            </li>
            <li class="lh" style="text-align:Left;list-style:none;"><span style="font-style:normal;font-weight:bold;text-decoration:underline;">Acknowledgment</span><span style="color:#000000;"><br></span>
            </li>
            <li style="margin-bottom:0.0pt;" value='<?php  echo ++$mainPageCounter; ?>'><span>I, <?php echo $person['name']; ?>, being the Donor named
                    in this Power of
                    attorney hereby acknowledge:</span><br><span style="color:#000000;"><br></span>
                <ol start="1" style="margin-top:-6.0pt;list-style:lower-alpha;">
                    <li value="1"><span>I have read and understand the nature and effect of this Power of
                            attorney;</span>
                    </li>
                    <li value="2"><span>I am of legal age in the Province of
                            <?php echo parseProvince($document['province']); ?> to grant a Power of attorney;
                            and</span>
                    </li>
                    <li value="3"><span>I am voluntarily giving this Power of attorney.</span>
                    </li>
                </ol>
            </li>
        </ol>
        <div>
            <p style="line-height:18.0pt;font-size:12.0pt;line-height:18.0pt;font-family:Times New Roman;color:#000000;text-align:Left;">
                <span style="font-style:normal;font-weight:bold;">IN WITNESS WHEREOF </span> I hereunto set my hand
                and seal at the City of <?php echo $signingDetails['city'];  ?> in the Province of
                <?php echo parseProvince($signingDetails['province']); ?>, this <?php echo date('l jS \of F Y'); ?>.
            </p>
            <div class=" keepTogether">
                <p style="line-height:18.0pt;font-size:12.0pt;line-height:18.0pt;font-family:Times New Roman;color:#000000;text-align:Left;">
                </p>
                <table style="line-height:18.0pt;margin-right:auto;width:100%;border-collapse:separate;border-spacing:0pt;">
                    <colgroup>
                        <col style="width:49%;">
                        <col style="width:1%;">
                        <col style="width:1%;">
                        <col style="width:49%;">
                    </colgroup>
                    <tbody>
                        <tr>
                            <td style="text-align:Left;vertical-align:Bottom;padding:2.0pt;width:49%;">
                                <p style="font-size:12.0pt;line-height:18.0pt;font-family:Times New Roman;color:#000000;text-align:Left;">
                                    <span style="font-style:normal;font-weight:bold;">SIGNED, SEALED, AND
                                        DELIVERED</span>
                                </p>
                            </td>
                            <td style="text-align:Right;vertical-align:Middle;padding:2.0pt;border:solid 1px #000000;border-width:1px 0 0 0;width:1%;">
                                &nbsp;
                            </td>
                            <td style="text-align:Left;vertical-align:Middle;padding:2.0pt;border:solid 1px #000000;border-width:0 0 0 1px;width:1%;">
                                &nbsp;
                            </td>
                            <td style="text-align:Left;vertical-align:Bottom;padding:2.0pt;width:49%;">&nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:Left;vertical-align:Bottom;padding:2.0pt;width:49%;">
                                <p style="font-size:12.0pt;line-height:18.0pt;font-family:Times New Roman;color:#000000;text-align:Left;">
                                    in the presence of:
                                </p>
                            </td>
                            <td style="text-align:Left;vertical-align:Bottom;padding:2.0pt;width:1%;">&nbsp;
                            </td>
                            <td style="text-align:Left;vertical-align:Middle;padding:2.0pt;border:solid 1px #000000;border-width:0 0 0 1px;width:1%;">
                                &nbsp;
                            </td>
                            <td style="text-align:Left;vertical-align:Bottom;padding:2.0pt;width:49%;">&nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:Left;vertical-align:Bottom;padding:2.0pt;width:49%;">&nbsp;
                            </td>
                            <td style="text-align:Left;vertical-align:Bottom;padding:2.0pt;width:1%;">&nbsp;
                            </td>
                            <td style="text-align:Left;vertical-align:Middle;padding:2.0pt;border:solid 1px #000000;border-width:0 0 0 1px;width:1%;">
                                &nbsp;
                            </td>
                            <td style="text-align:Left;vertical-align:Bottom;padding:2.0pt;width:49%;">&nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:Left;vertical-align:Bottom;padding:2.0pt;width:49%;">
                                <p style="font-size:12.0pt;line-height:18.0pt;font-family:Times New Roman;color:#000000;text-align:Left;">
                                    Witness: ______________________ (Sign)
                                </p>
                            </td>
                            <td style="text-align:Left;vertical-align:Bottom;padding:2.0pt;width:1%;">&nbsp;
                            </td>
                            <td style="text-align:Left;vertical-align:Middle;padding:2.0pt;border:solid 1px #000000;border-width:0 0 0 1px;width:1%;">
                                &nbsp;
                            </td>
                            <td style="text-align:Left;vertical-align:Bottom;padding:2.0pt;width:49%;">
                                <p style="font-size:12.0pt;line-height:18.0pt;font-family:Times New Roman;color:#000000;text-align:Left;">
                                    __________________________________
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:Left;vertical-align:Bottom;padding:2.0pt;width:49%;">
                                <p style="font-size:12.0pt;line-height:18.0pt;font-family:Times New Roman;color:#000000;text-align:Left;">
                                    Witness Name: ______________________
                                </p>
                            </td>
                            <td style="text-align:Left;vertical-align:Bottom;padding:2.0pt;width:1%;">&nbsp;
                            </td>
                            <td style="text-align:Left;vertical-align:Middle;padding:2.0pt;border:solid 1px #000000;border-width:0 0 0 1px;width:1%;">
                                &nbsp;
                            </td>
                            <td style="text-align:Left;vertical-align:Bottom;padding:2.0pt;width:49%;">
                                <p style="font-size:12.0pt;line-height:18.0pt;font-family:Times New Roman;color:#000000;text-align:Left;">
                                    <?php echo $person['name']; ?> (Donor)
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:Left;vertical-align:Bottom;padding:2.0pt;width:49%;">
                                <p style="font-size:12.0pt;line-height:18.0pt;font-family:Times New Roman;color:#000000;text-align:Left;">
                                    Address: ___________________________
                                </p>
                            </td>
                            <td style="text-align:Left;vertical-align:Bottom;padding:2.0pt;width:1%;">&nbsp;
                            </td>
                            <td style="text-align:Left;vertical-align:Middle;padding:2.0pt;border:solid 1px #000000;border-width:0 0 0 1px;width:1%;">
                                &nbsp;
                            </td>
                            <td style="text-align:Left;vertical-align:Bottom;padding:2.0pt;width:49%;">&nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:Left;vertical-align:Bottom;padding:2.0pt;width:49%;">
                                <p style="font-size:12.0pt;line-height:18.0pt;font-family:Times New Roman;color:#000000;text-align:Left;">
                                    ___________________________________
                                </p>
                            </td>
                            <td style="text-align:Right;vertical-align:Middle;padding:2.0pt;border:solid 1px #000000;border-width:0 0 1px 0;width:1%;">
                                &nbsp;
                            </td>
                            <td style="text-align:Left;vertical-align:Middle;padding:2.0pt;border:solid 1px #000000;border-width:0 0 0 1px;width:1%;">
                                &nbsp;
                            </td>
                            <td style="text-align:Left;vertical-align:Bottom;padding:2.0pt;width:49%;">&nbsp;
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div><br class="pageBreak">
        <div class=" keepTogether"><br class="pageBreak">
            <p style="line-height:18.0pt;font-size:12.0pt;line-height:18.0pt;font-family:Times New Roman;color:#000000;text-align:Center;">
                <span style="font-style:normal;font-weight:bold;text-decoration:underline;">NOTARY
                    ACKNOWLEDGMENT</span>
            </p>
            <span style="line-height:18.0pt;font-size:12.0pt;line-height:18.0pt;font-family:Times New Roman;color:#000000;"><br>The
                Province of <?php echo parseProvince($signingDetails['province']); ?><br><br>City/Town
                __________________<br><br>On this the ________ day of
                ________________, ________, before me, ____________________, the undersigned officer, personally
                appeared <?php echo $person['name']; ?>, known to me (or satisfactorily proven) to be the person whose
                name is subscribed to
                the within instrument and acknowledged that he/she executed the same as and for his/her respective
                act and deed for the purposes expressed therein. <br><br>In witness whereof I hereunto set my hand
                and seal.<br><br><br><br>________________________________________<br>A Notary Public in and for the
                Province of <?php echo parseProvince($signingDetails['province']); ?><br><br><br>My commission expires:
                ____________________<br><br><br></span>
        </div>
    </div>
    <div class="LDCopyright">
        <p>©2021 NFLD LAW (freewilllawyer.com)</p>
    </div>
</div>
</div>