<?php

    $this->data['PAGE']['demo']=0;

    $this->data['PAGE']['title'] = 'Register';
    $this->data['PAGE']['keywords'] = 'test';
    $this->data['PAGE']['description'] = 'test';
    $this->data['PAGE']['robots'] = 1; // Null = Follow
    $this->data['PAGE']['image'] = 'test';
    $this->data['PAGE']['canonical'] = APP_URL;
    $this->data['PAGE']['path'] = $this->page_path;
    $this->data['PAGE']['amphtml'] = NULL;
    $this->data['PAGE']['feed'] = NULL;

    $this->data['PAGE']['head'] = ' ';

    if ($_SESSION['M']['user'] ?? false) {
        header('Location: home');
        return 0;
    }

    include_once $this->PATH."global/head.php";
    include_once $this->PATH."global/header.php";
?>

<main role="main" class="container">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Register</div>
                    <div class="card-body">
                        <?php if ($this->data['activate']) { ?>
                            <?php if($this->data['active']) { ?>
                                <div class="alert alert-success">Your Account has been active, Now you can enjoy it...
                                <br>
                                <a href="../../../../index.php">Try Login</a>
                                </div>
                            <?php } else { ?>
                                <div class="alert alert-danger">Your Account has been not active, this link is expired/wrong!</div>
                            <?php } ?>
                        <?php } else { ?>
                        <form id="register" class="form-horizontal" method="post" action="user/register">

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-address-card" aria-hidden="true"></i></span>
                                </div>
                                <input type="text" class="form-control" minlength="3" name="fname" id="fname" placeholder="Enter your First Name" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-address-card" aria-hidden="true"></i></span>
                                </div>
                                <input type="text" class="form-control" minlength="3" name="lname" id="lname" placeholder="Enter your Last Name" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone-square" aria-hidden="true"></i></span>
                                </div>
                                <input type="number" class="form-control" name="phone" id="phone" placeholder="Enter your phone number" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                                </div>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter your Email" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-key" aria-hidden="true"></i></span>
                                </div>
                                <input type="password" class="form-control"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" name="password" id="password" placeholder="Enter your Password" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-key" aria-hidden="true"></i></span>
                                </div>
                                <input type="password" class="form-control" name="confirm" id="confirm" placeholder="Confirm your Password" required>
                            </div>

                            <div class="form-group"><label for="license" class="form-control-label">Terms &amp; conditions</label><textarea id="license" name="license" cols="20" rows="5" style="font-size:11px" readonly="" class="form-control">License Agreement

 This License Agreement is made and effective as of now by and between Sender Company, a company organized and existing in Sender Country, with a registered address at Sender Address ("Licensor") and Client Company, a company organized and existing in Client Country, with a registered address at Client Address ("Licensee").

WHEREAS:

 Licensee wishes to obtain a license to use Description of product (hereinafter, the "Asset"), and
 Licensor is willing to grant to the Licensee a non-exclusive, non-transferable License to use the Asset for the term and specific purpose set forth in this Agreement,
 NOW, THEREFORE, in consideration of the foregoing, and of the mutual promises and undertakings contained herein, and other good and valuable consideration, the parties agree as follows:

 1. Definitions
 1.1 "Agreement" means this License Agreement including the attached Schedule.

1.2 "Confidential Information" means information that:
 a. is by its nature confidential;
 b. is designated in writing by Licensor as confidential;
 c. the Licensee knows or reasonably ought to know is confidential;
 d. Information comprised in or relating to any Intellectual Property Rights of Licensor.

1.3 "Asset" means the Asset provided by Licensor as specified in Item 6 of the Schedule in the form as stated in Item 7 of the Schedule.

1.4 "Intellectual Property Rights" means all rights in and to any copyright, trademark, trading name, design, patent, know how (trade secrets) and all other rights resulting from intellectual activity in the industrial, scientific, literary or artistic field and any application or right to apply for registration of any of these rights and any right to protect or enforce any of these rights, as further specified in clause 5.

 1.5 "Party" means a person or business entity who has executed this Agreement; details of the Parties are specified in Item 2 of the Schedule.

1.6 "Term" means the term of this Agreement commencing on the Commencement Date as specified in Item 4 of the Schedule and expiring on the Expiry Date specified in Item 5 of the Schedule.

2. License Grant
 2.1 Licensor grants to the Licensee a non-exclusive, non-transferable License for the Term to use the Asset for the specific purpose specified in this Agreement, subject to the terms and conditions set out in this Agreement.

3. Charges
 3.1 In consideration of the Licensor providing the License under clause 2 of this License Agreement, the Licensee agrees to pay Licensor the amount of the License Charge as specified in Item 9 of the Schedule.

4. Licensee’s Obligations
 4.1 The Licensee cannot use the Asset, for purposes other than as specified in this Agreement and in Item 8 of the Schedule.

4.2 The Licensee may permit its employees to use the Asset for the purposes described in Item 8, provided that the Licensee takes all necessary steps and imposes the necessary conditions to ensure that all employees using the Asset do not commercialise or disclose the contents of it to any third person, or use it other than in accordance with the terms of this Agreement.

4.3 The Licensee will not distribute, sell, License or sub-License, let, trade or expose for sale the Asset to a third party.

4.4 No copies of the Asset are to be made other than as expressly approved by Licensor.

4.5 No changes to the Asset or its content may be made by Licensee.

4.6 The Licensee will provide technological and security measures to ensure that the Asset which the Licensee is responsible for is physically and electronically secure from unauthorised use or access.

4.7 Licensee shall ensure that the Asset retains all Licensor copyright notices and other proprietary legends and all trademarks or service marks of Licensor.

5. Intellectual Property Rights
 5.1 All Intellectual Property Rights over and in respect of the Asset are owned by Licensor. The Licensee does not acquire any rights of ownership in the Asset.

6. Limitation of Liability
 6.1 The Licensee acknowledges and agrees that neither Licensor nor its board members, officers, employees or agents, will be liable for any loss or damage arising out of or resulting from Licensor’s provision of the Asset under this Agreement, or any use of the Asset by the Licensee or its employees; and Licensee hereby releases Licensor to the fullest extent from any such liability, loss, damage or claim.

7. Confidentiality
 7.1 Neither Party may use, disclose or make available to any third party the other Party’s Confidential Information, unless such use or disclosure is done in accordance with the terms of this Agreement.

7.2 Each Party must hold the other Party’s Confidential Information secure and in confidence, except to the extent that such Confidential Information:
 a. is required to be disclosed according to the requirements of any law, judicial or legislative body or government agency; or
 b. was approved for release in writing by the other Party, but only to the extent of and subject to such conditions as may be imposed in such written authorisation.

7.3 This clause 7 will survive termination of this Agreement.

8. Disclaimers &amp; Release
 8.1 To the extent permitted by law, Licensor will in no way be liable to the Licensee or any third party for any loss or damage, however caused (including through negligence) which may be directly or indirectly suffered in connection with any use of the Asset.

8.2 The Asset is provided by Licensor on an "as is" basis.

8.3 Licensor will not be held liable by the Licensee in any way, for any loss, damage or injury suffered by the Licensee or by any other person related to any use of the Asset or any part thereof.

8.4 Notwithstanding anything contained in this Agreement, in no event shall Licensor be liable for any claims, damages or loss which may arise from the modification, combination, operation or use of the Asset with Licensee computer programs.

8.5 Licensor does not warrant that the Asset will function in any environment.

8.6 The Licensee acknowledges that: a. The Asset has not been prepared to meet any specific requirements of any party, including any requirements of Licensee; and b. it is therefore the responsibility of the Licensee to ensure that the Asset meets its own individual requirements.

8.7 To the extent permitted by law, no express or implied warranty, term, condition or undertaking is given or assumed by Licensor, including any implied warranty of merchantability or fitness for a particular purpose.

9. Indemnification
 9.1 The Licensee must indemnify, defend and hold harmless Licensor, its board members, officers, employees and agents from and against any and all claims (including third party claims), demands, actions, suits, expenses (including attorney’s fees) and damages (including indirect or consequential loss) resulting in any way from:

 a. Licensee’s and Licensee’s employee’s use or reliance on the Asset,
 b. any breach of the terms of this License Agreement by the Licensee or any Licensee employee, and
 c. any other act of Licensee.

9.2 This clause 9 will survive termination of this Agreement.

10. Waiver
 10.1 Any failure or delay by either Party to exercise any right, power or privilege hereunder or to insist upon observance or performance by the other of the provisions of this License Agreement shall not operate or be construed as a waiver thereof.

11. Governing Law
 11.1 This Agreement will be construed by and governed in accordance with the laws of [County]. The Parties submit to exclusive jurisdiction of the courts of [County].

12. Termination
 12.1 This Agreement and the License granted herein commences upon the Commencement Date and is granted for the Term, unless otherwise terminated by Licensor in the event of any of the following:

 a. if the Licensee is in breach of any term of this License Agreement and has not corrected such breach to Licensor’s reasonable satisfaction within 7 days of Licensor’s notice of the same;
 b. if the Licensee becomes insolvent, or institutes (or there is instituted against it) proceedings in bankruptcy, insolvency, reorganization or dissolution, or makes an assignment for the benefit of creditors; or
 c. the Licensee is in breach of clause 5 or 7 of this Agreement.

12.2 Termination under this clause shall not affect any other rights or remedies Licensor may have.

13. License Fee
 13.1 In consideration for the License grant described in this License Agreement, Licensee shall pay the yearly License fee as stated in Item 9 of the Schedule immediately upon execution of this Agreement and upon each anniversary date of this Agreement.

13.2 The License fee and any other amounts payable by the Licensee to the Licensor, under this Agreement, are exclusive of any and all foreign and domestic taxes, which if found to be applicable, will be invoiced to Licensee and paid by Licensee within 30 days of such invoice.

14. Assignment
 14.1 Licensee shall not assign any rights of this License Agreement, without the prior written consent of Licensor.

15. Notices
 15.1 All notices required under this Agreement shall be in writing and shall be deemed given (i) when delivered personally; (ii) five (5) days after mailing, when sent certified mail, return receipt requested and postage prepaid; or (iii) one (1) business day after dispatch, when sent via a commercial overnight carrier, fees prepaid. All notices given by either Party must be sent to the address of the other as first written above (unless otherwise changed by written notice).

 16. Counterparts
 16.1 This Agreement may be executed in any number of counterparts, each of which shall be deemed to be an original and all of which taken together shall constitute one instrument.

17. Severability
 17.1 The Parties recognize the uncertainty of the law with respect to certain provisions of this Agreement and expressly stipulate that this Agreement will be construed in a manner that renders its provisions valid and enforceable to the maximum extent possible under applicable law. To the extent that any provisions of this Agreement are determined by a court of competent jurisdiction to be invalid or unenforceable, such provisions will be deleted from this Agreement or
modified so as to make them enforceable and the validity and enforceability of the remainder of such provisions and of this Agreement will be unaffected.

18. Entire Agreement
 18.1 This Agreement contains the entire agreement between the Parties and supersedes any previous understanding, commitments or agreements, oral or written. Further, this Agreement may not be modified, changed, or otherwise altered in any respect except by a written agreement signed by both Parties.
</textarea></div>

                            <div class="input-group mb-3">
                                <div class="form-check agreement-wrapper">
                                    <input type="checkbox" class="form-check-input" id="agreement">
                                    <label class="form-check-label" for="exampleCheck1">I have read and agree to the Terms of Service</label>
                                </div>
                            </div>

                            <div class="form-group ">
                                <button type="submit" class="btn btn-primary btn-lg col-8 login-button">Register</button>
                                <small class="mx-3 text-muted border border-secondary rounded-circle p-1">OR</small>
                                <a class="btn btn-success my-2 my-sm-0" href="../../../../index.php">Login</a>
                            </div>
                            <hr>
                            <div class="form-group small text-center">
                                <p>
                                  You can signup as <span class="text-danger">vendor</span> to provide service and products, also create your own shop:
                                </p>
                                <a class="btn btn-sm btn-outline-info mx-auto" href="../../../../index.php">SignUp As Vendor</a>
                            </div>
                        </form>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<script>
    //  Confirm password check
    $('#password, #confirm').on('keyup', function () {
        $('#confirm').removeClass('border-success border-danger');
        if ($('#password').val() == $('#confirm').val()) {
            $('#confirm').addClass('border border-success');
        } else
            $('#confirm').addClass('border border-danger');
    });

    //  Register
    $('body').on('submit','form#register', function(event){
        event.preventDefault();
        if (!$('#agreement').is(':checked')) {
            $('.agreement-wrapper').addClass('alert alert-danger');
            return;
        };
        if (($('#password').val() == $('#confirm').val()) && ($('#password').val().length > 5)) {
            const id = $(this).attr('id');
            const reload = $(this).data('reload');
            const data = $(this).serialize();
            const classA = $(this).attr('action');
            ajaxCall (classA, data,function(response) {
                let obj = JSON.parse(response);
                $('form#register').fadeOut();
                $('form#register').html('<p class="small text-muted"><i class="text-success fa fa-check"></i> Account created,<br> Now check your mail (also spam box) for a link to activate your password.</p>');
                $('form#register').fadeIn();
            });
        } else {
            notify('Confirm password is not same as password','error',false);
        }
    });
</script>

<?php include_once $this->PATH."global/footer.php"; ?>