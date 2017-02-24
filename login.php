<?php require_once('header.php'); ?>
<div id="login" class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2">
            <h1>The Biggest Tracker</h1>
            <h2 class="text-center">Sign in to update your progress:</h2>
        </div>
    </div>
     <div id="results" class="row">
        <div id="results-card" class="col-xs-12 col-sm-4 col-sm-offset-4">
            <div class="row">
                <div class="col">
                    <form id="login">
                        <div id="card-inner">
                            <div id="search-error" class="row">
                                <div class="col">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" placeholder="you@flysalot.com">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" placeholder="********">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary">Go &rarr;</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once('footer.php'); ?>