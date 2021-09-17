<?php


function parseProvince($province) {
	$provinceName = ['Ontario', 'Quebec', 'Nove Soctia', 'New Brunswick', 'Manitoba', 'British Columbia', 
    'Prince Edward Island', 'Saskatchewan', 'Alberta', 'NewFoundland and Labrador'];
    $provinceValue = ['ON', 'QC', 'NS', 'NB', 'MB', 'BC', 'PE', 'SK', 'AB', 'NL'];

	for ($i = 0; $i < count($provinceName); $i++)
	{
		if ($provinceValue[$i] === $province)
		{
			return $provinceName[$i];
		}
	}
		return false;
}


?>


<div id="outputPage">
    <div data-exp="simple2" class="outputVersion1">
        <div>
            <div class=" outputDocument LastWill outputDocument">
                <div class=" firstFooter"></div>
                <p
                    style="line-height:18.0pt;font-size:12.0pt;line-height:18.0pt;font-family:Times New Roman;color:#000000;text-align:Center;">
                    <span style="font-style:normal;font-weight:bold;">LAST WILL AND TESTAMENT OF
                        <?php echo $person['name'];  ?></span>
                </p>
                <p
                    style="line-height:18.0pt;font-size:12.0pt;line-height:18.0pt;font-family:Times New Roman;color:#000000;text-align:Left;margin-left:12.0pt;">
                    I, <?php  echo $person['name']; ?>, presently of <?php  echo $person['city'] ?>,
                    <?php echo parseProvince($person['province']);  ?>, declare that this is my Last Will and Testament.
                </p>
                <ol start="1"
                    style="line-height:18.0pt;font-size:12.0pt;line-height:18.0pt;font-family:Times New Roman;color:#000000;list-style:decimal;">
                    <li class="lhl" style="text-align:Left;list-style:none;"><span
                            style="font-style:normal;font-weight:bold;"><br></span><span
                            style="font-style:normal;font-weight:bold;">PRELIMINARY DECLARATIONS</span><span
                            style="color:#000000;"><br></span>
                    </li>
                    <li class="lh" style="text-align:Left;list-style:none;"><span
                            style="font-style:normal;font-weight:bold;text-decoration:underline;">Prior Wills and
                            Codicils</span><span style="color:#000000;"><br></span>
                    </li>
                    <li style="margin-bottom:18.0pt;" value="1"><span>I revoke all prior Wills and Codicils.</span><span
                            style="color:#000000;"><br></span>
                    </li>
                    <li class="lh" style="text-align:Left;list-style:none;"><span
                            style="font-style:normal;font-weight:bold;text-decoration:underline;">Marital
                            Status</span><span style="color:#000000;"><br></span>
                    </li>
                    <li style="margin-bottom:18.0pt;" value="2"><span>
                            <?php 
							if ($person['relationship'] === 'married') {
								echo " I am married to ". $person['spouse'] . " ( my 'spouse')";
							} else if ($person['relationship'] === 'commonLaw') {
								echo "I am in a common law relationship with " . $person['spouse'] . " (my 'partner')";

							} else if ($person['relationship'] === 'single') {
								echo "	I am not married or in a common law relationship.";
							}
						?>

                        </span><span style="color:#000000;"><br></span>
                    </li>
                    <li class="lh" style="text-align:Left;list-style:none;"><span
                            style="font-style:normal;font-weight:bold;text-decoration:underline;">Current
                            Children</span><span style="color:#000000;"><br></span>
                    </li>
                    <li style="margin-bottom:18.0pt;" value="3">
                        <span>
                            <?php
						if ($person['children'] === 'true') {
							echo	'I have the following living children:';
						}
						else if ($person['children'] === 'false') {
							echo "I do not have any living children";
						}

						?>
                        </span>


                        <?php
					if ($person['children'] === 'true') {
						echo'
							<span style="color:#000000;"><br></span>
                        <ul style="list-style:disc;">

						';
					
						if (!empty($children['name']) && !empty($children['dependent'])) {
							for($i = 0; $i < sizeof($children['name']); $i++) {
								echo '<li style="margin-bottom:0.0pt;" value="'. $i .'"><span> '. $children['name'][$i]  .'</span><span
								style="color:#000000;"><br></span></li>';
							}
						
						
						echo '</ul>';

					}
				}
						?>
                    </li>
                    <li style="margin-bottom:18.0pt;" value="4"><span>The term 'child' or 'children' as used in this
                            Will includes the above listed children and any children of mine that are subsequently born
                            or legally adopted.</span><span style="color:#000000;"><br></span>
                    </li>
                    <li class="lhl" style="text-align:Left;list-style:none;"><span
                            style="font-style:normal;font-weight:bold;">EXECUTOR</span><span
                            style="color:#000000;"><br></span>
                    </li>
                    <li class="lh" style="text-align:Left;list-style:none;"><span
                            style="font-style:normal;font-weight:bold;text-decoration:underline;">Definition</span><span
                            style="color:#000000;"><br></span>
                    </li>
                    <li style="margin-bottom:18.0pt;" value="5"><span>The expression 'my Executor' used throughout this
                            Will includes either the singular or plural number, or the masculine or feminine gender as
                            appropriate wherever the fact or context so requires. The term 'executor' in this Will is
                            synonymous with and includes the terms 'personal representative', 'executrix' and
                            'trustee'.</span><span style="color:#000000;"><br></span>
                    </li>
                    <li class="lh" style="text-align:Left;list-style:none;"><span
                            style="font-style:normal;font-weight:bold;text-decoration:underline;">Appointment</span><span
                            style="color:#000000;"><br></span>
                    </li>
                    <li style="margin-bottom:18.0pt;" value="6"><span>I appoint <?php  echo $executor['name'] ?>
                            <?php  echo $executor['city']; ?> of
                            , <?php echo parseProvince($executor['province']); ?> as the sole Executor of this Will, but if
                            <?php echo $executor['name'];  ?> should predecease me, or should refuse or be unable to act
                            or
                            continue to act as my Executor, then I appoint <?php echo $altExecutor['name']  ?> of
                            <?php echo $altExecutor['city']; ?>, <?php echo parseProvince($altExecutor['province']); ?> to be the sole
                            Executor of this Will in the place of <?php echo $executor['name'];  ?></span><span
                            style="color:#000000;"><br></span>
                    </li>
                    <li style="margin-bottom:18.0pt;" value="7"><span>No bond or other security of any kind will be
                            required of any Executor appointed in this Will.</span><span
                            style="color:#000000;"><br></span>
                    </li>
                    <li class="lh" style="text-align:Left;list-style:none;"><span
                            style="font-style:normal;font-weight:bold;text-decoration:underline;">Powers of My
                            Executor</span><span style="color:#000000;"><br></span>
                    </li>
                    <li style="margin-bottom:18.0pt;" value="8"><span>I give and appoint to my Executor the following
                            duties and powers with respect to my estate:</span><span style="color:#000000;"><br></span>
                        <ol start="1" style="list-style:lower-alpha;">
                            <li style="margin-bottom:18.0pt;" value="1"><span>To pay my legally enforceable debts,
                                    funeral expenses and all expenses in connection with the administration of my estate
                                    and the trusts created by my Will as soon as convenient after my death. If any of
                                    the real property devised in my Will remains subject to a mortgage at the time of my
                                    death, then I direct that the devisee taking that mortgaged property will take the
                                    property subject to that mortgage and that the devisee will not be entitled to have
                                    the mortgage paid out or resolved from the remaining assets of the residue of my
                                    estate;</span><span style="color:#000000;"><br></span>
                            </li>
                            <li style="margin-bottom:18.0pt;" value="2"><span>To take all legal actions to have the
                                    probate of my Will completed as quickly and simply as possible, and as free as
                                    possible from any court supervision, under the laws of the Province of
                                    <?php echo parseProvince($person['province']);  ?>;</span><span style="color:#000000;"><br></span>
                            </li>
                            <li style="margin-bottom:18.0pt;" value="3"><span>To retain, exchange, insure, repair,
                                    improve, sell or dispose of any and all personal property belonging to my estate as
                                    my Executor deems advisable without liability for loss or depreciation;</span><span
                                    style="color:#000000;"><br></span>
                            </li>
                            <li style="margin-bottom:18.0pt;" value="4"><span>To invest, manage, lease, rent, exchange,
                                    mortgage, sell, dispose of or give options without being limited as to term and to
                                    insure, repair, improve, or add to or otherwise deal with any and all real property
                                    belonging to my estate as my Executor deems advisable without liability for loss or
                                    depreciation;</span><span style="color:#000000;"><br></span>
                            </li>
                            <li style="margin-bottom:18.0pt;" value="5"><span>To purchase, maintain, convert and
                                    liquidate investments or securities, and to vote stock, or exercise any option
                                    concerning any investments or securities without liability for loss;</span><span
                                    style="color:#000000;"><br></span>
                            </li>
                            <li style="margin-bottom:18.0pt;" value="6"><span>To open or close bank
                                    accounts;</span><span style="color:#000000;"><br></span>
                            </li>
                            <li style="margin-bottom:18.0pt;" value="7"><span>To maintain, continue, dissolve, change or
                                    sell any business which is part of my estate, or to purchase any business if deemed
                                    necessary or beneficial to my estate by my Executor;</span><span
                                    style="color:#000000;"><br></span>
                            </li>
                            <li style="margin-bottom:18.0pt;" value="8"><span>To maintain, settle, abandon, sue or
                                    defend, or otherwise deal with any lawsuits against my estate;</span><span
                                    style="color:#000000;"><br></span>
                            </li>
                            <li style="margin-bottom:18.0pt;" value="9"><span>To employ any lawyer, accountant or other
                                    professional; and</span><span style="color:#000000;"><br></span>
                            </li>
                            <li style="margin-bottom:0.0pt;" value="10"><span>Except as otherwise provided in this Will,
                                    to act as my Trustee by holding in trust the share of any minor beneficiary, and to
                                    keep such share invested, pay the income or capital or as much of either or both as
                                    my Executor considers advisable for the maintenance, education, advancement or
                                    benefit of such minor beneficiary and to pay or transfer the capital of such share
                                    or the amount remaining of that share to such beneficiary when he or she reaches the
                                    age of 18 years or, prior to such beneficiary reaching the age of 18 years, to pay
                                    or transfer such share to any parent or guardian of such beneficiary subject to like
                                    conditions and the receipt of any such parent or guardian discharges my
                                    Executor.</span><span style="color:#000000;"><br></span>
                            </li>
                        </ol>
                    </li>
                    <li style="margin-bottom:18.0pt;" value="9"><span>The above authority and powers granted to my
                            Executor are in addition to any powers and elective rights conferred by
                            provincial/territorial or federal law or by other provision of this Will and may be
                            exercised as often as required, and without application to or approval by any
                            court.</span><span style="color:#000000;"><br></span>
                    </li>
                    <li class="lhl" style="text-align:Left;list-style:none;"><span
                            style="font-style:normal;font-weight:bold;"><br></span><span
                            style="font-style:normal;font-weight:bold;">DISPOSITION OF ESTATE</span><span
                            style="color:#000000;"><br></span>
                    </li>
                    <li class="lh" style="text-align:Left;list-style:none;"><span
                            style="font-style:normal;font-weight:bold;text-decoration:underline;">Specific
                            Bequests</span><span style="color:#000000;"><br></span>
                    </li>


                    <?php 

						if ($gifts['gifts']  === 'true') {
							echo '<li style="margin-bottom:18.0pt;" value="10"><span>To receive a specific bequest under this Will a
                            beneficiary must survive me for thirty (30) days. Any item that fails to pass to a
                            beneficiary will return to my estate to be included in the residue of my estate. All
                            property given under this Will is subject to any encumbrances or liens attached to the
                            property. My specific bequests are as follows:</span><span
                            style="color:#000000;"><br></span>
                        <ol start="1" style="list-style:lower-alpha;">';
						
						// run 2 loops to get the fit

						if (!empty($gifts['charity']['name']))  {
							for ($i = 0; $i < count($gifts['charity']['name']); $i++)
							{
								
								echo '
                            <li style="margin-bottom:0.0pt;" ><span>I leave to '. $gifts['charity']['name'][$i] .' of
                                    '. $gifts['charity']['city'][$i] .' , '. parseProvince($gifts['charity']['province'][$i]) .'  , with the charitable registration number:
                                    '. $gifts['charity']['number'][$i] .', for their own use absolutely, the following: '. $gifts['charity']['description'][$i] .'</span><span
                                    style="color:#000000;"><br></span>
                            </li>';
							}
						}

						if (!empty($gifts['individual']['name'])) {

							for ($i = 0; $i < count($gifts['individual']['name']); $i++)
							{
								echo '<li style="margin-bottom:0.0pt;"><span>I leave to '. $gifts['individual']['name'][$i] .' of '. $gifts['individual']['city'][$i] .', '. parseProvince($gifts['individual']['province'][$i]) .', if they shall survive me, for their own use absolutely, the following: ' . $gifts['individual']['description'][$i].'</span><span style="color:#000000;"><br></span>
								</li>';
							}
						}

						
                        echo '</ol></li>';

						} 

					?>


                    <li class="lh" style="text-align:Left;list-style:none;"><span
                            style="font-style:normal;font-weight:bold;text-decoration:underline;">Distribution of
                            Residue</span><span style="color:#000000;"><br></span>
                    </li>
                    <li style="margin-bottom:18.0pt;" value="11"><span>To receive any gift or property under this Will a
                            beneficiary must survive me for thirty (30) days. Beneficiaries of my estate residue will
                            receive and share all of my property and assets not specifically bequeathed or otherwise
                            required for the payment of any debts owed, including but not limited to, expenses
                            associated with the probate of my Will, the payment of taxes, funeral expenses or any other
                            expense resulting from the administration of my Will. The entire estate residue is to be
                            divided between my designated beneficiaries with the beneficiaries receiving a share of the
                            entire estate residue. &nbsp;All property given under this Will is subject to any
                            encumbrances or liens attached to the property.</span><span
                            style="color:#000000;"><br></span>
                    </li>
                    <li style="margin-bottom:18.0pt;" value="12"><span>I direct my Executor to divide the residue of my
                            estate into one hundred (100) equal shares which will be distributed as follows ("Share
                            Allocations"):</span><span style="color:#000000;"><br></span>
                        <ol start="1" style="list-style:lower-alpha;">

                            <?php 

					
							if (!empty($remainder['individual']['name'])) {

								for ($i = 0; $i < count($remainder['individual']['name']); $i++)
								{
									echo '   <li style="margin-bottom:0.0pt;"><span>'. $remainder['individual']['name'][$i] .' of '. $remainder['individual']['city'][$i] .', '.  parseProvince($remainder['individual']['province'][$i]) .', will
                                    receive '. $remainder['individual']['share'][$i] .' shares of the residue of my estate.</span><span
                                    style="color:#000000;"><br></span></li>';
								}
							}

							if (!empty($remainder['charity']['name'])) {

								for ($i = 0; $i < count($remainder['charity']['name']); $i++)
								{
									echo '<li style="margin-bottom:0.0pt;"><span>'. $remainder['chairty']['name'][$i] .' of '. $remainder['charity']['city'][$i] .', '. parseProvince($remainder['charity']['province'][$i]) .', with the charitable registration number: '. $remainder['charity']['number'][$i] .', will receive '.$remainder['charity']['share'][$i]  .' shares of the residue of my estate.</span><span style="color:#000000;"><br></span></li>';
								}
							}
						?>

                        </ol>
                    </li>
                    <li style="margin-bottom:18.0pt;" value="13"><span>Provided however, if any beneficiary and
                            alternate beneficiary, if one was appointed, shall die before becoming entitled in
                            accordance with the terms of my Will, to receive the whole of his or her share of the
                            residue of my estate, such share or the amount remaining of that share will be divided
                            amongst the remaining beneficiaries in shares proportionate to the above Share
                            Allocations.</span><span style="color:#000000;"><br></span>
                    </li>
                    <li class="lh" style="text-align:Left;list-style:none;"><span
                            style="font-style:normal;font-weight:bold;text-decoration:underline;">Wipeout
                            Provision</span><span style="color:#000000;"><br></span>
                    </li>
                    <li style="margin-bottom:18.0pt;" value="14"><span>Should I leave no children, child, grandchildren
                            or grandchild surviving me, or should they all die before becoming entitled to receive the
                            whole of their share of my estate, then I direct my Executor to divide any remaining residue
                            of my estate into one hundred (100) equal shares and to pay and transfer such shares as
                            follows:</span><span style="color:#000000;"><br></span>
                        <ol start="1" style="list-style:lower-alpha;">


						<?php 
						
							if ($wipeout['divideEstate'] ==='true')  {
							echo '<li><span>100 shares to be divided equally between my parents and siblings, or the
								survivors thereof, for their own use absolutely, if all or any of them is then
								alive. If any of these beneficiaries shall die before becoming entitled, in
								accordance with the terms of this Will, to receive the whole of his or her share of
								my estate, but such beneficiary has a child or children which survive me, that
								beneficiary shall be deemed to have survived me for the purposes of this
								distribution. </span><span style="color:#000000;"><br></span>
						</li>';

							} else if ($wipeout['divideEstate'] === 'false')
							{
								echo '<li style="margin-bottom:0.0pt;"><span>100 shares to this '. $wipeout['name'] .' of '. $wipeout['city'] .', '. parseProvince($wipeout['province']) .' for their own use absolutely, if they are alive.</span><span style="color:#000000;"><br></span>
								</li>';
							}
						
						?>
                            
                        </ol>
                    </li>


                    <li class="lhl" style="text-align:Left;list-style:none;"><span
                            style="font-style:normal;font-weight:bold;"><br></span><span
                            style="font-style:normal;font-weight:bold;">CHILDREN</span><span
                            style="color:#000000;"><br></span>
                    </li>
                    <li class="lh" style="text-align:Left;list-style:none;"><span
                            style="font-style:normal;font-weight:bold;text-decoration:underline;">Guardian for Minor and
                            Dependent Children</span><span style="color:#000000;"><br></span>
                    </li>
                    <li style="margin-bottom:18.0pt;" value="15"><span>Should my minor or dependent children require a
                            guardian to care for them, I appoint the following individual to be their guardian (the
                            'Guardian'): </span><span style="color:#000000;"><br></span>
                        <ol start="1" style="list-style:lower-alpha;">
                            <li style="margin-bottom:0.0pt;" value="1"><span>I appoint <?php echo  $guardian['name']  ?> of <?php echo $guardian['city'];  ?>,
                                    <?php echo parseProvince($guardian['province']);  ?> to be
                                    the sole Guardian of all my minor and dependent children until they are at least 18
                                    years of age.</span><span style="color:#000000;"><br></span>
                            </li>
                        </ol>
                    </li>


                    <li class="lhl" style="text-align:Left;list-style:none;"><span
                            style="font-style:normal;font-weight:bold;"><br></span><span
                            style="font-style:normal;font-weight:bold;">TESTAMENTARY TRUST</span><span
                            style="color:#000000;"><br></span>
                    </li>
                    <li class="lh" style="text-align:Left;list-style:none;"><span
                            style="font-style:normal;font-weight:bold;text-decoration:underline;">Testamentary Trust For
                            Minor Beneficiaries</span><span style="color:#000000;"><br></span>
                    </li>
                    <li style="margin-bottom:18.0pt;" value="16"><span>It is my intent to create a testamentary trust
                            (the "Testamentary Trust") for each minor beneficiary named in this Will. I name my
                            Executor(s) as trustee (the "Trustee") of any and all Testamentary Trusts required in this
                            Will. Any assets bequeathed, transferred, or gifted to a minor beneficiary named in this
                            Will are to be held in a separate trust by the Trustee until that minor beneficiary reaches
                            the designated age. Any property left by me to any minor beneficiary in this Will shall be
                            given to my Executor(s) to be managed until that minor beneficiary reaches the age of
                            <?php  

							if ($Inheritance['delay'] === 'false') {
								echo "18";
							} else if ($Inheritance['delay'] === 'true') {
								echo $Inheritance['age']; 
							} else {
								echo "18";
							}
							?>.</span><span style="color:#000000;"><br></span>
                    </li>
                    <li class="lh" style="text-align:Left;list-style:none;"><span
                            style="font-style:normal;font-weight:bold;text-decoration:underline;">Trust
                            Administration</span><span style="color:#000000;"><br></span>
                    </li>
                    <li style="margin-bottom:18.0pt;" value="17"><span>The Trustee shall manage the Testamentary Trust
                            as follows:</span><span style="color:#000000;"><br></span>
                        <ol start="1" style="list-style:lower-alpha;">
                            <li style="margin-bottom:18.0pt;" value="1"><span>The assets and property will be managed
                                    for the benefit of the minor until the minor reaches the age set by me for final
                                    distribution;</span><span style="color:#000000;"><br></span>
                            </li>
                            <li style="margin-bottom:18.0pt;" value="2"><span>Upon the minor reaching the age set by me
                                    for final distribution, all property and assets remaining in the trust will be
                                    transferred to the minor beneficiary as quickly as possible; and</span><span
                                    style="color:#000000;"><br></span>
                            </li>
                            <li style="margin-bottom:0.0pt;" value="3"><span>Until the minor beneficiary reaches the age
                                    set by me for final distribution, my Trustee will keep the assets of the trust
                                    invested and pay the whole or such part of the net income derived therefrom and any
                                    amount or amounts out of the capital that my Trustee may deem advisable to or for
                                    the support, health, maintenance, education, or benefit of that minor
                                    beneficiary.</span><span style="color:#000000;"><br></span>
                            </li>
                        </ol>
                    </li>
                    <li style="margin-bottom:18.0pt;" value="18"><span>The Trustee may, in the Trustee's discretion,
                            invest and reinvest trust funds in any kind of real or personal property and any kind of
                            investment, provided that the Trustee acts with the care, skill, prudence and diligence,
                            considering all financial and economic considerations, that a prudent person acting in a
                            similar capacity and familiar with such matters would use.</span><span
                            style="color:#000000;"><br></span>
                    </li>
                    <li style="margin-bottom:18.0pt;" value="19"><span>No bond or other security of any kind will be
                            required of any Trustee appointed in this Will.</span><span
                            style="color:#000000;"><br></span>
                    </li>
                    <li class="lh" style="text-align:Left;list-style:none;"><span
                            style="font-style:normal;font-weight:bold;text-decoration:underline;">Trust
                            Termination</span><span style="color:#000000;"><br></span>
                    </li>
                    <li style="margin-bottom:18.0pt;" value="20"><span>The Testamentary Trust will end after any of the
                            following:</span><span style="color:#000000;"><br></span>
                        <ol start="1" style="list-style:lower-alpha;">
                            <li style="margin-bottom:18.0pt;" value="1"><span>The minor beneficiary reaching the age set
                                    by me for final distribution;</span><span style="color:#000000;"><br></span>
                            </li>
                            <li style="margin-bottom:18.0pt;" value="2"><span>The minor beneficiary dies; or</span><span
                                    style="color:#000000;"><br></span>
                            </li>
                            <li style="margin-bottom:0.0pt;" value="3"><span>The assets of the trust are exhausted
                                    through distributions.</span><span style="color:#000000;"><br></span>
                            </li>
                        </ol>
                    </li>
                    <li class="lh" style="text-align:Left;list-style:none;"><span
                            style="font-style:normal;font-weight:bold;text-decoration:underline;">General Trust
                            Provisions</span><span style="color:#000000;"><br></span>
                    </li>
                    <li style="margin-bottom:18.0pt;" value="21"><span>The expression 'my Trustee' used throughout this
                            Will includes either the singular or plural number, or the masculine or feminine gender as
                            appropriate wherever the fact or context so requires.</span><span
                            style="color:#000000;"><br></span>
                        <p style="text-align:Left;"><span style="font-style:normal;font-weight:bold;">(1) Powers of
                                Trustee</span>
                        </p>
                        <p style="text-align:Left;margin-top:12.0pt;">To carry out the terms of my Will, I give my
                            Trustee the following powers to be used in his or her discretion at any time in the
                            management of a trust created hereunder, namely:
                        </p>
                        <ol start="1" style="list-style:lower-alpha;">
                            <li style="margin-bottom:18.0pt;" value="1"><span>The power to make such expenditures as are
                                    necessary to carry out the purpose of the trust;</span><span
                                    style="color:#000000;"><br></span>
                            </li>
                            <li style="margin-bottom:18.0pt;" value="2"><span>Subject to my express direction to the
                                    contrary, the power to sell, call in and convert into money any trust property,
                                    including real property, that my Trustee in his or her discretion deems
                                    advisable;</span><span style="color:#000000;"><br></span>
                            </li>
                            <li style="margin-bottom:18.0pt;" value="3"><span>Subject to my express direction to the
                                    contrary, the power to mortgage trust property where my Trustee considers it
                                    advisable to do so;</span><span style="color:#000000;"><br></span>
                            </li>
                            <li style="margin-bottom:18.0pt;" value="4"><span>Subject to my express direction to the
                                    contrary, the power to borrow money where my Trustee considers it advisable to do
                                    so;</span><span style="color:#000000;"><br></span>
                            </li>
                            <li style="margin-bottom:18.0pt;" value="5"><span>Subject to my express direction to the
                                    contrary, the power to lend money to the trust beneficiary if my Trustee considers
                                    it is in the best interest of the beneficiary to do so;</span><span
                                    style="color:#000000;"><br></span>
                            </li>
                            <li style="margin-bottom:18.0pt;" value="6"><span>To make expenditures for the purpose of
                                    repairing, improving and rebuilding any property;</span><span
                                    style="color:#000000;"><br></span>
                            </li>
                            <li style="margin-bottom:18.0pt;" value="7"><span>To exercise all rights and options of an
                                    owner of any securities held in trust;</span><span
                                    style="color:#000000;"><br></span>
                            </li>
                            <li style="margin-bottom:18.0pt;" value="8"><span>To lease trust property, including real
                                    estate, without being limited as to term;</span><span
                                    style="color:#000000;"><br></span>
                            </li>
                            <li style="margin-bottom:18.0pt;" value="9"><span>To make investments he or she considers
                                    advisable, without being limited to those investments authorized by law for
                                    trustees;</span><span style="color:#000000;"><br></span>
                            </li>
                            <li style="margin-bottom:18.0pt;" value="10"><span>To receive additional property from any
                                    source and in any form of ownership;</span><span style="color:#000000;"><br></span>
                            </li>
                            <li style="margin-bottom:18.0pt;" value="11"><span>Instead of acting personally, to employ
                                    and pay any other person or persons, including a body corporate, to transact any
                                    business or to do any act of any nature in relation to a trust created under my Will
                                    including the receipt and payment of money, without being liable for any loss
                                    incurred. And I authorize my Trustee to appoint from time to time upon such terms as
                                    he or she may think fit any person or persons, including a body corporate, for the
                                    purpose of exercising any powers herein expressly or impliedly given to my Trustee
                                    with respect to any property belonging to the trust;</span><span
                                    style="color:#000000;"><br></span>
                            </li>
                            <li style="margin-bottom:18.0pt;" value="12"><span>Without the consent of any persons
                                    interested in trusts established hereunder, to compromise, settle or waive any claim
                                    or claims at any time due to or by the trust in such manner and to such extent as my
                                    Trustee considers to be in the best interest of the trust beneficiary, and to make
                                    an agreement with any other person, persons or corporation in respect thereof, which
                                    shall be binding upon such beneficiary;</span><span
                                    style="color:#000000;"><br></span>
                            </li>
                            <li style="margin-bottom:18.0pt;" value="13"><span>To make or not make any election,
                                    determination, designation or allocation required or permitted to be made by my
                                    Trustee (either alone or jointly with others) under any of the provisions of any
                                    municipal, provincial/territorial, federal, or other taxing statute, in such manner
                                    as my Trustee, in his or her absolute discretion, deems advisable, and each such
                                    election, determination, designation or allocation when so made shall be final and
                                    binding upon all persons concerned;</span><span style="color:#000000;"><br></span>
                            </li>
                            <li style="margin-bottom:18.0pt;" value="14"><span>To pay himself or herself a reasonable
                                    compensation out of the trust assets; and</span><span
                                    style="color:#000000;"><br></span>
                            </li>
                            <li style="margin-bottom:0.0pt;" value="15"><span>To employ and rely on the advice given by
                                    any attorney, accountant, investment advisor, or other agent to assist the Trustee
                                    in the administration of this trust and to compensate them from the trust
                                    assets.</span><span style="color:#000000;"><br></span>
                            </li>
                        </ol>
                        <p style="text-align:Left;">The above authority and powers granted to my Trustee are in addition
                            to any powers and elective rights conferred by statute or federal law or by other provision
                            of this Will and may be exercised as often as required, and without application to or
                            approval by any court.<br>
                        </p>
                        <p style="text-align:Left;"><span style="font-style:normal;font-weight:bold;">(2) Other
                                Provisions</span>
                        </p>
                        <ol start="1" style="margin-top:-6.0pt;list-style:lower-alpha inside;">
                            <li style="margin-bottom:18.0pt;" value="1">
                                <div style="margin-top:-18.0pt;padding-left:20.0pt;"><span>Subject to the terms of this
                                        Will, I direct that my Trustee will not be liable for any loss to my estate or
                                        to any beneficiary resulting from the exercise by him or her in good faith of
                                        any discretion given him or her in this Will;</span><span
                                        style="color:#000000;"><br></span>
                                </div>
                            </li>
                            <li style="margin-bottom:18.0pt;" value="2">
                                <div style="margin-top:-18.0pt;padding-left:20.0pt;"><span>Any trust created in this
                                        Will shall be administered as independently of court supervision as possible
                                        under the laws of the Province or Territory having jurisdiction over the trust;
                                        and</span><span style="color:#000000;"><br></span>
                                </div>
                            </li>
                            <li style="margin-bottom:0.0pt;" value="3">
                                <div style="margin-top:-18.0pt;padding-left:20.0pt;"><span>If any trust condition is
                                        held invalid, it will not affect other provisions that can be given effect
                                        without the invalid provision.</span><span style="color:#000000;"><br></span>
                                </div>
                            </li>
                        </ol>
                    </li>
                    <li class="lhl" style="text-align:Left;list-style:none;"><span
                            style="font-style:normal;font-weight:bold;"><br></span><span
                            style="font-style:normal;font-weight:bold;">GENERAL PROVISIONS</span><span
                            style="color:#000000;"><br></span>
                    </li>
                    <li class="lh" style="text-align:Left;list-style:none;"><span
                            style="font-style:normal;font-weight:bold;text-decoration:underline;">Individuals Omitted
                            From Bequests</span><span style="color:#000000;"><br></span>
                    </li>
                    <li style="margin-bottom:18.0pt;" value="22"><span>If I have omitted to leave property in this Will
                            to one or more of my heirs as named above or have provided them with zero shares of a
                            bequest, the failure to do so is intentional.</span><span style="color:#000000;"><br></span>
                    </li>
                    <li class="lh" style="text-align:Left;list-style:none;"><span
                            style="font-style:normal;font-weight:bold;text-decoration:underline;">Insufficient
                            Estate</span><span style="color:#000000;"><br></span>
                    </li>
                    <li style="margin-bottom:18.0pt;" value="23"><span>If the value of my estate is insufficient to
                            fulfill all of the bequests described in this Will then I give my Executor full authority to
                            decrease each bequest by a proportionate amount.</span><span
                            style="color:#000000;"><br></span>
                    </li>

					<?php 

						if ($provisions['addinalClause'] === 'true') {
							echo ' <li class="lh" style="text-align:Left;list-style:none;"><span
                            style="font-style:normal;font-weight:bold;text-decoration:underline;">Additional
                            Provisions</span><span style="color:#000000;"><br></span></li>';


							echo ' <li style="margin-bottom:18.0pt;" value="24"><span>'. $provisions['message'] .'</span><span
                            style="color:#000000;"><br></span></li>';
						}
					?>
                   

                    <li class="lh" style="text-align:Left;list-style:none;"><span
                            style="font-style:normal;font-weight:bold;text-decoration:underline;">No Contest
                            Provision</span><span style="color:#000000;"><br></span>
                    </li>
                    <li style="margin-bottom:18.0pt;" value="26"><span>If any beneficiary under this Will contests in
                            any court any of the provisions of this Will, then each and all such persons shall not be
                            entitled to any devises, legacies, bequests, or benefits under this Will or any codicil
                            hereto, and such interest or share in my estate shall be disposed of as if that contesting
                            beneficiary had not survived me.</span><span style="color:#000000;"><br></span>
                    </li>
                    <li class="lh" style="text-align:Left;list-style:none;"><span
                            style="font-style:normal;font-weight:bold;text-decoration:underline;">Severability</span><span
                            style="color:#000000;"><br></span>
                    </li>
                    <li style="margin-bottom:0.0pt;" value="27"><span>If any provisions of this Will are deemed
                            unenforceable, the remaining provisions will remain in full force and effect.</span><span
                            style="color:#000000;"><br></span>
                    </li>
                </ol>
                <div class=" keepTogether">
                    <p
                        style="line-height:18.0pt;font-size:12.0pt;line-height:18.0pt;font-family:Times New Roman;color:#000000;text-align:Left;">
                        IN WITNESS WHEREOF, I have signed my name on this the ________ day of ________________,
                        ________, at __________________________, <?php echo parseProvince($person['province']);  ?>, declaring and
                        publishing this instrument
                        as my Last Will, in the presence of the undersigned witnesses, who witnessed and subscribed this
                        Last Will at my request, and in my presence.<br><br>_____________________________<br><?php echo $person['name']; ?>
                        (Testator) Signature
                    </p>
                    <p
                        style="line-height:18.0pt;font-size:12.0pt;line-height:18.0pt;font-family:Times New Roman;color:#000000;text-align:Left;">
                        SIGNED AND DECLARED by <?php echo $person['name']; ?> on the ________ day of ________________, ________ to be the
                        Testator's Last Will, in our presence, at __________________________,
                        <?php echo parseProvince($person['province']);  ?>, who at the
                        Testator's request and in the presence of the Testator and of each other, all being present at
                        the same time, have signed our names as witnesses.
                    </p>
                    <table
                        style="line-height:18.0pt;margin-right:auto;width:100%;border-collapse:separate;border-spacing:0pt;">
                        <colgroup>
                            <col style="width:50%;">
                            <col style="width:50%;">
                        </colgroup>
                        <tbody>
                            <tr>
                                <td style="text-align:Left;vertical-align:Middle;padding:2.0pt;width:50%;">
                                    <p
                                        style="font-size:12.0pt;line-height:18.0pt;font-family:Times New Roman;color:#000000;text-align:Left;">
                                        <br>________________________<br>Witness #1
                                        Signature<br>________________________<br>Witness #1 Name (Please
                                        Print)<br>________________________<br>Witness #1 Street
                                        Address<br>________________________<br>Witness #1 City/Province
                                    </p>
                                </td>
                                <td style="text-align:Left;vertical-align:Middle;padding:2.0pt;width:50%;">
                                    <p
                                        style="font-size:12.0pt;line-height:18.0pt;font-family:Times New Roman;color:#000000;text-align:Left;">
                                        <br>________________________<br>Witness #2
                                        Signature<br>________________________<br>Witness #2 Name (Please
                                        Print)<br>________________________<br>Witness #2 Street
                                        Address<br>________________________<br>Witness #2 City/Province
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class=" outputDocument affidavitOfExecution outputDocument">
                
                <div class=" firstFooter"></div>
                <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
                <div class=" keepTogether"><br class="pageBreak">
                    <p style="line-height:18.0pt;font-size:12.0pt;line-height:18.0pt;font-family:Times New Roman;color:#000000;text-align:Center;"
                        class="documentTitle"><span style="font-style:normal;font-weight:bold;">AFFIDAVIT OF
                            EXECUTION</span>
                    </p>
                    <p
                        style="line-height:18.0pt;font-size:12.0pt;line-height:18.0pt;font-family:Times New Roman;color:#000000;text-align:Left;">
                        CANADA<br><br>PROVINCE OF <?php echo parseProvince($person['province']);  ?><br><br>TO WIT:
                    </p>
                    <p
                        style="line-height:18.0pt;font-size:12.0pt;line-height:18.0pt;font-family:Times New Roman;color:#000000;text-align:Left;">
                        I, ________________, of ____________, <?php echo parseProvince($person['province']);  ?>, <span
                            style="font-style:normal;font-weight:bold;">MAKE OATH AND SAY THAT:</span>
                    </p>
                    <ol start="1"
                        style="line-height:18.0pt;font-size:12.0pt;line-height:18.0pt;font-family:Times New Roman;color:#000000;list-style:decimal;">
                        <li style="margin-bottom:18.0pt;" value="1"><span>I was personally present and did see <?php echo $person['name']; ?>, who
                                is known to me to be the person named in the attached Last Will and Testament ("the
                                Instrument"), duly sign the Instrument.</span><span style="color:#000000;"><br></span>
                        </li>
                        <li style="margin-bottom:18.0pt;" value="2"><span>The Instrument was signed at
                                __________________________, <?php echo parseProvince($person['province']);  ?>.</span><span
                                style="color:#000000;"><br></span>
                        </li>
                        <li style="margin-bottom:18.0pt;" value="3"><span>That I am the subscribing witness to the
                                Instrument.</span><span style="color:#000000;"><br></span>
                        </li>
                        <li style="margin-bottom:18.0pt;" value="4"><span><?php echo $person['name']; ?> was personally present and did see me duly
                                sign the Instrument.</span><span style="color:#000000;"><br></span>
                        </li>
                        <li style="margin-bottom:0.0pt;" value="5"><span>That I believe the person named in the
                                instrument, whose signature I witnessed, <?php echo $person['name']; ?>, is at least the age of majority in
                                <?php echo parseProvince($person['province']);  ?>.</span><span style="color:#000000;"><br></span>
                        </li>
                    </ol>
                    <p
                        style="line-height:18.0pt;font-size:12.0pt;line-height:18.0pt;font-family:Times New Roman;color:#000000;text-align:Left;">
                        <br>
                    </p>
                    <table
                        style="line-height:18.0pt;margin-right:auto;width:100%;border-collapse:separate;border-spacing:0pt;">
                        <colgroup>
                            <col style="width:48%;">
                            <col style="width:4%;">
                            <col style="width:48%;">
                        </colgroup>
                        <tbody>
                            <tr>
                                <td style="text-align:Left;vertical-align:Middle;padding:2.0pt;width:48%;">
                                    <p
                                        style="font-size:12.0pt;line-height:18.0pt;font-family:Times New Roman;color:#000000;text-align:Left;">
                                        SWORN BEFORE ME at _____________, <?php echo parseProvince($person['province']);  ?> this
                                        ________ day of
                                        ________________, ________.
                                    </p>
                                </td>
                                <td
                                    style="text-align:Left;vertical-align:Middle;padding:2.0pt;border:solid 1px #000000;border-width:1px 1px 0 0;width:4%;">
                                    &nbsp;
                                </td>
                                <td style="text-align:Left;vertical-align:Middle;padding:2.0pt;width:48%;">
                                    <p
                                        style="font-size:12.0pt;line-height:18.0pt;font-family:Times New Roman;color:#000000;text-align:Left;">
                                        <br> &nbsp;________________________<br> &nbsp;Signature
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:Left;vertical-align:Middle;padding:2.0pt;width:48%;">
                                    <p
                                        style="font-size:12.0pt;line-height:18.0pt;font-family:Times New Roman;color:#000000;text-align:Left;">
                                        <br>________________________<br>A Commissioner for Oaths/Notary Public in and
                                        for the Province of <?php echo parseProvince($person['province']);  ?><br>My Commission
                                        expires: ____________
                                    </p>
                                </td>
                                <td
                                    style="text-align:Left;vertical-align:Middle;padding:2.0pt;border:solid 1px #000000;border-width:0 1px 1px 0;width:4%;">
                                    &nbsp;
                                </td>
                                <td style="text-align:Left;vertical-align:Middle;padding:2.0pt;width:48%;">
                                    <p
                                        style="font-size:12.0pt;line-height:18.0pt;font-family:Times New Roman;color:#000000;text-align:Left;">
                                        &nbsp;________________________<br> &nbsp;Name
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      
    </div>
</div>          <br/><br/><br/><br/><br/><br/>
<div style='margin-top: 200px;'>
            <p>©2021 NFLD LAW (freewillLawyer)®</p>
        </div>