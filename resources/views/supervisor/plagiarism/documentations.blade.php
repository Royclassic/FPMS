
@extends('layouts.member-app')
@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="{{ $pageIcon }}"></i> Documentation</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">@lang('app.menu.home')</a></li>
                <li class="active">Documentation</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <h2>Plagiarism Results</h2>

                <ul class="list-group" id="issues-list">

                    <?php
                    include_once(__DIR__ . '/../../../vendor/copyleaks/php-plagiarism-checker/autoload.php');

                    use Copyleaks\CopyleaksCloud;
                    use Copyleaks\CopyleaksProcess;
                    use Copyleaks\Products;

                    $config = new \ReflectionClass('Copyleaks\Config');
                    $clConst = $config->getConstants();
                    $email = 'ianmadara96@gmail.com';
                    $apiKey = '86804e85-e9db-4766-b098-1a832bba05ce';
                    try {
                        $clCloud = new CopyleaksCloud($email, $apiKey, Products::Education);
                        $access_token = $clCloud->loginToken->tokenArr['access_token'];
                    } catch (Exception $e) {
                        echo "<Br/>Failed to connect to Copyleaks Cloud with exception: " . $e->getMessage();
                        die();
                    }

                    if (!isset($clCloud->loginToken) || !$clCloud->loginToken->validate()) {
                        echo "<Br/><strong>Bad login credentials</strong>";
                        die();
                    }


                    try {
                        // For more information about the optional headers please visit: https://api.copyleaks.com/GeneralDocumentation/RequestHeaders
                        $additionalHeaders = array($clConst['SANDBOX_MODE_HEADER'], // Sandbox mode - Scan without consuming any credits and get back dummy results

                        );
                        $process = $clCloud->createByFile(public_path('documentations/' . $documentation->student->user->email.'/'.$documentation->chapterOne->file), $additionalHeaders);

                    } catch (Exception $e) {

                        echo "<br/>Failed with exception: " . $e->getMessage();
                    }
                    while ($process->getStatus() != 100) {
                        sleep(2);
                    }
                    $results = $process->getResult();
                    echo "<BR/><strong>Scanned File:</strong><BR/>";
                    echo $documentation->chapterOne->file;
                    echo "<BR/><strong>Total Words of Document:</strong><BR/>";
                    print_r($clCloud->getResultComparisonReport($results[0])['TotalWords']);
                    echo "<BR/><strong>Credit</strong><BR/>";
                    $ARRAYS = $clCloud->getCreditBalance();
                    foreach ($ARRAYS as $arr){
                        echo $arr["Amount"];
                    }

                    foreach ($results as $result) {
                        echo $result;
                    }


                    //build table from PHP array
                    function build_table($array)
                    {
                        // start table
                        $html = '<table>';
                        // header row
                        $html .= '<tr>';
                        foreach ($array[0] as $key => $value) {
                            $html .= '<th>' . $key . '</th>';
                        }
                        $html .= '</tr>';

                        // data rows
                        foreach ($array as $key => $value) {
                            $html .= '<tr>';
                            foreach ($value as $key2 => $value2) {
                                $value2 = is_array($value2) ? json_encode($value2) : $value2;
                                $html .= '<td>' . @$value2 . '</td>';
                            }
                            $html .= '</tr>';
                        }

                        // finish table and return it

                        $html .= '</table>';
                        return $html;
                    }

                    //print process list as HTML table
                    if (isset($plist, $plist['response']) && count($plist['response']) > 0)
                        echo build_table($plist['response']);
                    ?>

                    <a target="_blank" href="<?php print_r($results[0]->EmbededComparison);?>" ><button class="btn btn-success">View Comparison Report</button></a>

                </ul>
            </div>
        </div>

    </div>
    <!-- .row -->

@endsection

