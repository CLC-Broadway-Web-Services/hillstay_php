const additionalRulesInputs = document.getElementById('additionalRulesInputs');
const additionalRulesValue = document.getElementById('additionalRulesValue');
const errorAditionalRules = document.getElementById('errorAditionalRules');

function addAditionalRules() {
    var value = additionalRulesValue.value;
    if (value.trim()) {
        // console.log(value)
        errorAditionalRules.setAttribute('hidden', 'hidden')
        const DIV = document.createElement('DIV');
        DIV.classList.add('addAdditionalRrules');

        const INPUT = document.createElement('INPUT');
        INPUT.setAttribute('type', 'text');
        INPUT.setAttribute('readonly', 'readonly');
        INPUT.setAttribute('name', 'additoinal_rules[]');
        INPUT.style.display = 'inline';
        INPUT.value = value.trim();

        const ICON = document.createElement('I');
        ICON.setAttribute('onclick', 'removeRule(this)');
        ICON.classList.add('fa');
        ICON.classList.add('fa-close');
        ICON.style.color = '#113814';
        ICON.style.fontSize = '32px';
        ICON.style.lineHeight = '53px';
        ICON.style.float = 'right';
        ICON.style.right = '0';
        ICON.style.paddingRight = '5px';
        ICON.style.paddingLeft = '5px';
        ICON.style.cursor = 'pointer';
        ICON.style.position = 'absolute';

        DIV.appendChild(INPUT);
        DIV.appendChild(ICON);
        additionalRulesInputs.appendChild(DIV);

        additionalRulesValue.value = '';
    } else {
        errorAditionalRules.removeAttribute('hidden');
        console.log('no value');
        additionalRulesValue.value = '';
    }
}

function removeRule(event) {
    $(event).closest('div').remove();
}

$(".detailsChange").change(function () {
    var desc = this.name + '_desc';
    if (this.checked) {
        $('#' + desc).attr('required', 'required')
        $('#' + desc).removeAttr('hidden')
    } else {
        $('#' + desc).removeAttr('required')
        $('#' + desc).attr('hidden', 'hidden')
    }
});

{/* <div class="addAdditionalRrules">
    <input type="text" name="additoinal_rules[]" style="display:inline;" value="no fighting" readonly>
    <i class="fa fa-close" onclick="removeRule(this)" style="color: #113814;font-size: 32px;line-height: 53px;float: right;position: absolute;
    right: 0;padding-right: 5px; padding-left: 5px; cursor: pointer;"></i>
</div> */}