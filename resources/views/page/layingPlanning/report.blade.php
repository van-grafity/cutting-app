<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAYING PLANNING & CUTTING REPORT</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">


</head>
<body>
    <div>
        <table width="100%">
            <table width="100%">
                <tr>
                    <td width="50%" style="font-weight: bold; font-size: 14px;">
                        PT. GHIM LI INDONESIA
                    </td>
                    <td width="50%" style="text-align: right; font-size: 10px;">
                        RP-GLA-CUT-002-00<br>
                        Rev 00<br>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center; font-weight: bold; font-size: 14px;">
                        LAYING PLANNING & CUTTING REPORT
                        <br>
                        <div style="font-size: 10px;">{{ $data->serial_number }}</div>
                    </td>
                </tr>
            </table>
            <br/>
            <table width="100%" style="font-size: 10px; font-weight: bold; padding-top: 2 !important; padding-bottom: 2 !important; padding-left: 4 !important; padding-right: 4 !important;">
                <tr>
                    <td width="6%">Buyer</td>
                    <td>{{ $data->buyer->name }}</td>
                    <td></td>
                    <td></td>
                    <td width="8%">Fabric P/O</td>
                    <td>{{ $data->fabric_po }}</td>
                    <td width="10%" style="text-align: right;">Delivery Date:</td>
                    <td width="8%" style="text-align: right;">
                        {{ date('d-M-Y', strtotime($data->delivery_date)) }}
                    </td>
                </tr>

                <tr>
                    <td width="6%">Style</td>
                    <td>{{ $data->style->style }}</td>
                    <td width="6%">Order Qty</td>
                    <td>{{ $data->order_qty }}</td>
                    <td width="8%">Fabric Type</td>
                    <td>{{ $data->fabricType->description }}</td>
                    <td width="10%" style="text-align: right;">Plan Date:</td>
                    <td width="8%" style="text-align: right;">
                        {{ date('d-M-Y', strtotime($data->plan_date)) }}
                    </td>
                </tr>
                <tr>
                    <td width="6%">GL</td>
                    <td>{{ $data->gl->gl_number }}</td>
                    <td width="6%">Total Qty</td>
                    <td>{{ $data->order_qty }}</td>
                    <td width="8%">Fabric Cons</td>
                    <td>{{ $data->fabricCons->description }} {{ $data->fabric_cons_qty }}</td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td width="6%">Color</td>
                    <td>{{ $data->color->color }}</td>
                    <td width="6%"></td>
                    <td></td>
                    <td width="8%">Description</td>
                    <td>{{ $data->style->description }}</td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
            <br/>
            @php
                $length = count($data->layingPlanningSize);
                $total = 0;
                foreach ($data->layingPlanningSize as $item)
                {
                    $total += $item->quantity;
                }
                
            @endphp
            <table class="table table-bordered" style="width:100%; font-size: 10px; font-weight: bold; margin-bottom: 0 !important; padding-bottom: 0 !important;">
                <thead>
                    <tr>
                        <th rowspan="3">No</br>Laying</br>Sheet</th>
                        <th rowspan="3">Batch #</br>No.</th>
                        <th colspan="{{ $length }}">Size/Order</th>
                        <th rowspan="2">Total</th>
                        <th rowspan="3">Yds</br>Qty</th>
                        <th rowspan="3">Marker</br>Code</th>
                        <th rowspan="3">LOT</th>
                        <th colspan="3">Marker</th>
                        <th colspan="{{ $length }}">Ratio</th>
                        <th rowspan="3">Lay</br>Qty</th>
                        <th rowspan="3">Cut</br>Qty</th>
                        <th rowspan="3">Date</th>
                        <th rowspan="3">Layer</th>
                        <th rowspan="3">Cutter</th>
                        <th rowspan="3">Emb</br>Print</th>
                        <th rowspan="3">Sew</br>Line</th>
                    </tr>
                    <tr>
                        @foreach ($data->layingPlanningSize as $item)
                        <th>{{ $item->size->size }}</th>
                        @endforeach
                        <th rowspan="2">Length</th>
                        <th rowspan="2">Yds</th>
                        <th rowspan="2">Inch</th>
                        @foreach ($data->layingPlanningSize as $item)
                        <th>{{ $item->size->size }}</th>
                        @endforeach
                    </tr>
                    <tr>
                        @foreach ($data->layingPlanningSize as $item)
                        <th>{{ $item->quantity }}</th>
                        @endforeach
                        <th colspan="1">{{ $total }}</th>
                        @foreach ($data->layingPlanningSize as $item)
                        <th>{{ $item->quantity }}</th>
                        @endforeach
                </thead>

                <tbody>
                    @foreach ($details as $detail)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td></td>
                        @foreach ($detail->layingPlanningDetailSize as $item)
                        <td>{{ $item->qty_per_size }}</td>
                        @endforeach
                        <td>
                            <?php
                            $total_qty_per_size = 0;
                            foreach ($detail->layingPlanningDetailSize as $item)
                            {
                                $total_qty_per_size += $item->qty_per_size;
                            }
                            echo $total_qty_per_size;
                            ?>
                        </td>
                        <td>{{ $detail->total_length }}</td>
                        <td>{{ $detail->marker_code }}</td>
                        <td>{{ $detail->table_number }}</td>
                        <td>{{ $detail->marker_length }}</td>
                        <td>{{ $detail->marker_yard }}</td>
                        <td>{{ $detail->marker_inch }}</td>
                        @foreach ($detail->layingPlanningDetailSize as $item)
                        <td>{{ $item->ratio_per_size }}</td>
                        @endforeach
                        <td>{{ $detail->layer_qty }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="2">Pcs FOR SAMPLE</td>
                        @foreach ($data->layingPlanningSize as $item)
                        <td><?php
                            $total_per_size = 0;
                            foreach ($details as $detail)
                            {
                                foreach ($detail->layingPlanningDetailSize as $size)
                                {
                                    if ($size->size_id == $item->size_id)
                                    {
                                        $total_per_size += $size->qty_per_size;
                                    }
                                }
                            }
                            echo $total_per_size;
                        ?></td>
                        @endforeach
                        <td><?php
                            $total_all_size = 0;
                            foreach ($details as $detail)
                            {
                                foreach ($detail->layingPlanningDetailSize as $size)
                                {
                                    $total_all_size += $size->qty_per_size;
                                }
                            }
                            echo $total_all_size;
                        ?></td>
                        <td><?php
                            $total_length = 0;
                            foreach ($details as $detail)
                            {
                                $total_length += $detail->total_length;
                            }
                            echo $total_length;
                        ?></td>
                        <td><?php
                            $marker_code = [];
                            foreach ($details as $detail)
                            {
                                array_push($marker_code, $detail->marker_code);
                            }
                            $marker_code = array_unique($marker_code);
                            $marker_code = array_values($marker_code);
                            $total_marker_code = count($marker_code);
                            echo $total_marker_code;
                        ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        @foreach ($data->layingPlanningSize as $item)
                        <td></td>
                        @endforeach
                        <td><?php
                            $total = 0;
                            foreach ($details as $detail)
                            {
                                try
                                {
                                    $total += $detail->layer_qty;
                                }
                                catch (Exception $e)
                                {
                                    $total += 0;
                                }
                            }
                            echo $total;
                        ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        @foreach ($data->layingPlanningSize as $item)
                        <td><?php
                            $total_per_size = 0;
                            foreach ($details as $detail)
                            {
                                foreach ($detail->layingPlanningDetailSize as $size)
                                {
                                    if ($size->size_id == $item->size_id)
                                    {
                                        $total_per_size += $size->qty_per_size;
                                    }
                                }
                            }
                            echo $total_per_size - $item->quantity;
                        ?></td>
                        @endforeach
                        <td><?php
                            $total_all_size = 0;
                            foreach ($details as $detail)
                            {
                                foreach ($detail->layingPlanningDetailSize as $size)
                                {
                                    $total_all_size += $size->qty_per_size;
                                }
                            }
                            echo $total_all_size - $total;
                        ?></td>
                        <td><?php
                            $total = 0;
                            foreach ($data->layingPlanningSize as $item)
                            {
                                $total += $item->quantity;
                            }
                            $total_all_size = 0;
                            foreach ($details as $detail)
                            {
                                foreach ($detail->layingPlanningDetailSize as $size)
                                {
                                    $total_all_size += $size->qty_per_size;
                                }
                            }
                            echo round($total_all_size / $total * 100, 2);
                        ?>%</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        {{-- @foreach ($details->layingPlanning->layingPlanningSize as $item) --}}
                        @foreach ($data->layingPlanningSize as $item)
                        <td></td>
                        @endforeach
                        {{-- @endforeach --}} 
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td width="15px !important" height="15px !important"></td>
                    </tr>
                </tbody>
            </table>

            <table width="100%" style="font-size: 10px; font-weight: bold;">
                <tr>
                    <td width="20%">Total Layer Qty base on Marker Code</td>
                    <td width="60%" colspan="7">: <?php
                        $marker_code = [];
                        $total_layer = 0;
                        foreach ($details as $detail)
                        {
                            array_push($marker_code, $detail->marker_code);
                        }
                        $marker_code = array_unique($marker_code);
                        $marker_code = array_values($marker_code);
                        foreach ($marker_code as $code)
                        {
                            foreach ($details as $detail)
                            {
                                if ($code == $detail->marker_code)
                                {
                                    $total_layer += $detail->layer_qty;
                                }
                            }
                            echo $code . ' = ' . $total_layer . ' ';
                            $total_layer = 0;
                        }
                    ?></td>
                </tr>
            </table>
            
            <table width="100%" style="font-size: 12px; font-family: Times New Roman, Times, serif; font-weight: bold;">
                <tr>
                    <td width="50%" style="text-align: center;">
                        <p>Prepared by:</p>
                        <p></p>
                        <p>____________________</p>
                    </td>
                    <td width="50%" style="text-align: center;">
                        <p>Authorized by:</p>
                        <p></p>
                        <p>____________________</p>
                    </td>
                    <td width="50%" style="text-align: center;">
                        <p>Approved by:</p>
                        <p></p>
                        <p>____________________</p>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>

<style type="text/css">
    * {
        font-family: Calibri, san-serif;
    }
    @page {
        margin-top: 1cm;
        margin-left: 0.4cm;
        margin-right: 0.4cm;
        margin-bottom: 1cm;
    }
    table.table-bordered > thead > tr > th{
        border-top: 1px solid black;
        border-bottom: 1px solid black;
        border-left: 1px solid black;
        border-right: 1px solid black;
    }

    .table thead th {
        text-align: center;
        vertical-align: middle;
        font-size: 8px;
        padding-top: 1 !important;
        padding-bottom: 1 !important;
        padding-left: 0.3 !important;
        padding-right: 0.3 !important;
    }
    .table tbody td {
        border: 1px solid;
        text-align: center;
        vertical-align: middle;
        font-weight: bold;
        font-size: 9.2px;
        padding-top: 1.5 !important;
        padding-bottom: 1.5 !important;
        padding-left: 0.3 !important;
        padding-right: 0.3 !important;
        margin-bottom: 0px !important;
    }
</style>