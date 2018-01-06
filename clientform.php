<form action="<?php echo get_url($language, "Confirmation")?>" method="post">

    <h3>Personal data</h3>

    <p>
        <label>Name:<abbr title="This field is mandatory">*</abbr></label>
        <input name="client[name]" maxlength="20" required/>
    </p>

    <p>
        <label>E-Mail:<abbr title="This field is mandatory">*</abbr></label>
        <input type="email" name="client[email]" maxlength="30" required/>
    </p>
    <p>
        <label>Phone:<abbr title="This field is mandatory">*</abbr></label>
        <input type="tel" name="client[tel]" pattern="[0-9]{10}" required />
    </p>

    <h3>Delivery address</h3>
    <p>
        <label>Street:<abbr title="This field is mandatory">*</abbr></label>
        <input name="client[street]" maxlength="20" required/>
    </p>
    <p>
        <label>Zip code:<abbr title="This field is mandatory">*</abbr></label>
        <input type="text" name="client[zip]" maxlength="20" pattern="[1-9][0-9]{3}" required/>
    </p>
    <p>
        <label>City:<abbr title="This field is mandatory">*</abbr></label>
        <input name="client[city]" maxlength="20" required/>
    </p>
    <p>
        <label>Country:</label>
        <input disabled="disabled" value="Switzerland" />
    </p>
    <br />
    <p>
        <label>Comments (optional):</label>
        <textarea name="client[comment]" rows="5" cols="30" maxlength="150"></textarea>
    </p>

    <p>
        <button type='submit' name="action" class="button-price next">
            <span>Next  <i class="fa fa-angle-right" aria-hidden="true"></i></span>
        </button>
    </p>
</form>
