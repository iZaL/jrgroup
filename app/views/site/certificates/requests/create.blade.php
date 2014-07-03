@extends('site.master')

@section('content')
{{ HTML::style('assets/css/ion.rangeSlider.css') }}
{{ HTML::style('assets/css/ion.rangeSlider.skinSimple.css') }}
{{ HTML::script('assets/js/ion.rangeSlider.min.js') }}

<h1>Request Certificate</h1>

{{ Form::open(array('action' => 'CertificateRequestsController@store')) }}
    <div class="row">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        {{ Form::label('type', 'Type:') }}
                        {{ Form::select('type_id',$types,NULL,array('class'=>'form-control','id'=>'type_id')) }}
                    </div>
                </div>
                <div class="col-md-3">
                    <h2><span id="type-price">0</span>  KD</h2>
                </div>
            </div>

            <?php $i = 0; ?>
            @foreach($metas as $meta)
            <?php $option = ['' => 'Select Certificate options'] + $meta->options->lists('name','id'); ?>
            <div class="row">
                <div class="col-md-9">
                    @if($option)
                    <div class="form-group">
                        <label>{{ $meta->name }} </label>
                        {{ Form::select('option_id'.$i,$option,NULL,array('class'=>'form-control options','onChange'=>'getOptionPrice('.$i.', this)')) }}
                    </div>
                    @endif
                </div>
                <div class="col-md-3">
                    <h2><span id="option-price{{$i}}" class="option-prices">0</span> KD</h2>
                </div>
            </div>

            <?php $i++; ?>
            @endforeach

            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        {{ Form::label('quantity', 'Quantity:') }}
                        {{ Form::text('quantity', NULL,array('class'=>'form-control')) }}
                    </div>
                </div>
                <div class="col-md-3">
                    <h2><span id="quantity-value">0</span></h2>
                </div>
            </div>
            <div class="form-group">
                {{ Form::submit('Submit', array('class' => 'btn btn-info')) }}
            </div>
        </div>
        <div class="col-md-2">
            <div id="total">
                <h2>Total :</h2>
                <h2 id="total-amount">

                </h2>
            </div>
        </div>
    </div>

{{ Form::close() }}

@if ($errors->any())
<div class="alert alert-danger alert-block">
    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
</div>
@endif
<script>
    // fetch price from db async
    var typeVal = $('#type_id').val();
    var typePrice = $('#type-price');
    var total = $('#total-amount');
    var quantityVal = $('#quantity-value');

    function fetchTypePrice() {
        var typeId = $('#type_id').val();
        if (typeId) {
            $.ajax({
                url: '/admin/certificate-type/' + typeId + '/get-price',
                type: 'GET',
                cache: true,
                dataType: "json",
                error: function (xhr, textStatus, errorThrown) {
                    //
                    return false;
                },
                success: function (data) {
                    if (data) {
                        typePrice.html(data);
                        return true;
                    }
                }
            });
        } else {
            return false;
        }
    }

    // fetch price from db async
    function fetchOptionPrice(optionId, priceDiv) {
        var optionPriceDiv = $('#option-price' + priceDiv);
        optionPriceDiv.empty();
        if (typeVal) {
            $.ajax({
                url: '/admin/certificate-option/' + typeVal + '/option/' + optionId + '/get-price',
                type: 'GET',
                cache: true,
                dataType: "json",
                error: function (xhr, textStatus, errorThrown) {
                    return false;
                },
                success: function (data) {
                    if (data) {
                        optionPriceDiv.html(data);
                        return true;
                    }
                }
            });
        } else {
            return false;
        }
    }

    $("#type_id").change(function () {
        fetchTypePrice();

        //update options
        $('.options').each(function (priceDiv, obj) {
            var optionId = obj.value;
            fetchOptionPrice(optionId, priceDiv)
        });
    });

    // option_id on change function
    function getOptionPrice(priceDiv, obj) {

        if (isNaN(typeVal)) {
            alert('Please Select Certificate Type First');
        }
        var optionId = obj.value;
        fetchOptionPrice(optionId, priceDiv);
    }

    // on document load
    function getOptPrice() {
        $('.options').each(function (priceDiv, obj) {
            var optionId = obj.value;
            fetchOptionPrice(optionId, priceDiv)
        });
    }

    // calculate total price
    function calculate(obj) {
        quantityVal.html(obj.fromNumber);
        var quantity = obj.fromNumber;
        var typePrice = parseInt($('#type-price').html());
        var prices = [];
        var sum = 0;
        $('.option-prices').each(function () {
            var price = parseInt($(this).html());
            if (price) {
                prices.push(price);
            }
        });
        // push price to prices array
        prices.push(typePrice);

        // add price from prices array
        $(prices).each(function (i, value) {
            sum = sum + value;
        })

        var amount = sum * quantity;

        total.html(amount + 'KD');
    }

    $("#quantity").ionRangeSlider({
        min: 0,
        max: 100,
        type: 'single',
        step: 1,
        from: 1,
        postfix: " certificates",
        prettify: false,
        hasGrid: true,
        onFinish: function (obj) {
            calculate(obj);
            // calculate price
        }
    });

    $('document').ready(function () {
        // reset quantity
        // get selected prices
        fetchTypePrice();
        getOptPrice();
    });
</script>
@stop