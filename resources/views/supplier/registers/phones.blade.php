<div class="col-lg-5 col-md-5 col-sm-5 mt-2 mb-2 phoneNum">
    <div class="form-group">
        <label>
            Phone Number
            <i class="far fa-trash-alt float-right deletePhoneNum"></i>
        </label>
        @include("supplier.registers.selectPhoneCountry",['codeName' => $codename, 'codeValue'=>$codevalue])
        <input class="form-control col-8 float-right" type="number" name="{{ $phonename }}" pattern="[1-9]+" title="Please add numbers only" value="{{ $phonevalue }}"
            placeholder="Add your company phone" aria-describedby="helpId">
    </div>
</div>
