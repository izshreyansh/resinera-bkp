<div class="row">
    <div class="col-md-8">
        {{ Form::checkbox('flat_rate_enabled', trans('setting::attributes.flat_rate_enabled'), trans('setting::settings.form.enable_flat_rate'), $errors, $settings) }}
        {{ Form::text('translatable[flat_rate_label]', trans('setting::attributes.translatable.flat_rate_label'), $errors, $settings, ['required' => true]) }}

        <p class="m-2 text-danger italic">
            All costs are in paisa.
        </p>
        <br />

        {{ Form::number('flat_rate_below_500_cost', "Cost For Less than 500 grams", $errors, $settings, ['min' => 0, 'required' => true]) }}
        {{ Form::number('flat_rate_below_2000_cost', "Cost For 500-2000 grams", $errors, $settings, ['min' => 0, 'required' => true]) }}
        {{ Form::number('flat_rate_above_2000_cost', "Cost For above 2000 grams", $errors, $settings, ['min' => 0, 'required' => true]) }}
    </div>
</div>
