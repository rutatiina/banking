<div class="transactions_tax_form_fields">

    <hr>

    <div class="form-group">
        <label class="control-label col-lg-3">Bank charge(If any): </label>
        <div class="col-lg-9">
            <div class="input-group">
                <span class="input-group-addon label-roundless">{{$bank_account->currency}}</span>
                <input type="text" name="_bank_charge" value="" class="_bank_charge_field form-control text-right" placeholder="0.00">
                <span class="input-group-addon switchery-xs">
                    <input type="checkbox" class="switchery _tax_base_field" name="_tax_base" value="bank_charge">
                    Is taxable amount
                </span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-3 control-label">Tax:</label>
        <div class="col-lg-4">
            <select name="_tax_id" data-placeholder="Select Tax" class="select-search">
                <option value=""></option>
                @foreach ($taxes as $tax)
                    <option value="{{$tax->id}}" data-value="{{$tax->value}}" data-method="{{$tax->method}}">{{$tax->display_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-5">
            <div class="input-group">
                <input type="text" name="_tax_amount" value="" class="form-control input-roundless text-right" placeholder="0.00">
                <span class="input-group-addon label-roundless">{{$bank_account->currency}}</span>
            </div>
        </div>
    </div>

    <div class="form-group" title="Show/Hide Bank charge or Tax Reference">
        <label class="control-label col-lg-3"> </label>
        <div class="col-lg-9"><button type="button" class="btn btn-link" onclick="$('._reference_fields_').toggleClass('hidden')">
                <i class="icon-comment-discussion position-left"></i> Show/Hide Bank charge or Tax Reference</button>
        </div>
    </div>

    <div class="form-group _reference_fields_ hidden" title="Bank charge Reference">
        <label class="control-label col-lg-3">Bank charge Ref ... </label>
        <div class="col-lg-9">
            <input type="text" name="reference_bank_charge" value="" class="form-control" placeholder="Bank charge Reference">
        </div>
    </div>

    <div class="form-group _reference_fields_ hidden" title="Tax Reference">
        <label class="control-label col-lg-3">Tax Reference</label>
        <div class="col-lg-9">
            <input type="text" name="reference_tax" value="" class="form-control" placeholder="Tax Reference">
        </div>
    </div>

    <hr>

    <!-- todo taxes -->

</div>