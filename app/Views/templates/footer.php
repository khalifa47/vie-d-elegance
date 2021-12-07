<footer id="myFooter">
    <div class="container-fluid">
        <div class="row text-center">
            <div class="col-12 col-sm-6 col-md-3">
                <h1 class="logo" style="margin-top:30px;"><a href="#">&nbsp;<img id="logo-footer" src="<?= base_url('assets/img/logo.png') ?>">&nbsp;</a></h1>
            </div>
            <div class="col-12 col-sm-6 col-md-2">
                <h5>Get started</h5>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/login">Log In</a></li>
                </ul>
            </div>
            <div class="col-12 col-sm-6 col-md-2">
                <h5>Our Company</h5>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Company Information<br></a></li>
                    <li><a href="#">Reviews</a></li>
                    <li><a href="#">Contacts</a></li>
                </ul>
            </div>
            <div class="col-sm-6 col-md-2">
                <h5>Support</h5>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Help Desk<br></a></li>
                    <li><a href="#">Forums</a></li>
                    <li></li>
                </ul>
            </div>
            <div class="col-md-3 social-networks">
                <div></div><a class="facebook" href="https://www.facebook.com" target="_blank"><i class="fa fa-facebook"></i></a><a class="twitter" href="https://www.twitter.com" target="_blank"><i class="fa fa-twitter"></i></a><a class="linkedin" href="https://www.linkedin.com" target="_blank"><i class="fa fa-linkedin"></i></a><button class="btn btn-primary" style="margin-top:20px;" type="button">Contact us</button>
            </div>
        </div>
        <div class="row footer-copyright">
            <div class="col">
                <p>© <?= getdate()["year"] ?> Copyright<a href="#"></a></p>
            </div>
        </div>
    </div>
</footer>
<script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox-plus-jquery.js"></script>

<script>
    $('#wallet-modal').on('shown.bs.modal', () => {
        $('#topUpInput').trigger('focus');
    });

    const editCateg = (categID, categName) => {
        const form = `<form id='editForm${categID}' class='editcategform'>
            <input type='text' class='form-control editcategfield' value="${categName}" id='categField${categID}' required>
            <button type='submit' class='btn'><i class='fa fa-check' aria-hidden='true'></i></button>
        </form>`;
        $(`#categ_div${categID}`).html(form);

        $(`#editForm${categID}`).on("submit", (e) => {
            const new_categ_name = $(`#categField${categID}`).val();

            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '<?= base_url('CategoriesController/editCategory') ?>',
                data: {
                    categoryID: categID,
                    categoryName: new_categ_name
                },
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                dataType: 'json',
                contentType: 'application/x-www-form-urlencoded',
                cache: false,

                success: (response) => {
                    if (response.status == 1) {
                        alert(response.message);
                    } else {
                        alert(response.message);
                    }
                }

            });

        });
    };
    const deleteCateg = (categID) => {
        if (confirm(`Confirm deletion of category with ID: ${categID}?`)) {
            $.ajax({
                type: 'POST',
                url: '<?= base_url('CategoriesController/deleteCategory') ?>',
                data: {
                    categoryID: categID
                },
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                dataType: 'json',
                contentType: 'application/x-www-form-urlencoded',
                cache: false,

                success: (response) => {
                    if (response.status == 1) {
                        alert(response.message);
                    } else {
                        alert(response.message);
                    }
                }

            });
        }
    };

    const goToCateg = (categID) => {
        window.location.href = `/items?${categID}`;
    };

    $(document).ready(() => {
        $('#walletForm').on('submit', (e) => {
            const uid = $('#walletUid').val();
            const amount = $('#topUpInput').val();
            const current_bal = $('#current-balance').val();

            const newBal = parseFloat(current_bal) + parseFloat(amount);

            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '<?= base_url('WalletController/topup') ?>',
                data: {
                    uid: uid,
                    amount: amount,
                    newBalance: newBal
                },
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                dataType: 'json',
                contentType: 'application/x-www-form-urlencoded',
                cache: false,

                success: (response) => {
                    if (response.status == 1) {
                        alert(response.message);
                        $('#walletBalance')[0].innerHTML = response.newBal;
                    } else {
                        alert(response.message);
                    }
                }

            });
        });
    });
</script>
</body>

</html>