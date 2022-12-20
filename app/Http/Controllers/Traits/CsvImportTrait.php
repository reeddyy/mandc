<?php

namespace App\Http\Controllers\Traits;

use Carbon\Carbon;
use \SpreadsheetReader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

trait CsvImportTrait
{
    public function processCsvImport(Request $request)
    {
        try {
            $filename = $request->input('filename', false);
            $path     = storage_path('app/csv_import/' . $filename);

            $hasHeader = $request->input('hasHeader', false);

            $fields = $request->input('fields', false);
            $fields = array_flip(array_filter($fields));

            $modelName = $request->input('modelName', false);
            $model     = 'App\\Models\\' . $modelName;

            $reader = new SpreadsheetReader($path);
            $insert = [];

            foreach ($reader as $key => $row) {
                if ($hasHeader && $key == 0) {
                    continue;
                }

                $tmp = [];

                foreach ($fields as $header => $k) {
                    if (isset($row[$k])) {
                        $tmp[$header] = $row[$k];
                    }
                }

                if (count($tmp) > 0) {
                    $insert[] = $tmp;
                }
            }

            $for_insert = array_chunk($insert, 100);

            $for_insert_without_blanks = array();

            switch ($model) {
                case 'App\Models\Certificate':
                    foreach ($for_insert as $insert_item) {
                        foreach ($insert_item as $k => $item) {
                            foreach ($item as $key => $value) {
                                if (isset($item["credential_reference"]) && $item["credential_reference"] != "") {
                                    if (isset($item["date_awarded"])) {
                                        if (str_contains($item["date_awarded"], "/")) {
                                            $item["date_awarded"] = Carbon::createFromFormat('d/m/Y', $item["date_awarded"])->format('Y-m-d');
                                        } else {
                                            $item["date_awarded"] = Carbon::parse($item["date_awarded"])->format('Y-m-d');
                                        }
                                    }
                                    if ($value == "") {
                                        unset($item[$key]);
                                    }
                                } else {
                                    session()->flash('message', 'Credential reference is mandatory! Please check csv and try again.');

                                    return redirect($request->input('redirect'));
                                }
                            }
                            array_push($for_insert_without_blanks, $item);
                        }
                    }
                    $for_insert_without_blanks = array_chunk($for_insert_without_blanks, 100);
                    foreach ($for_insert_without_blanks as $insert_item) {
                        foreach ($insert_item as $item) {
                            $model::updateOrCreate(
                                ['credential_reference' => $item['credential_reference']],
                                array_diff_key($item, array_flip(["credential_reference"]))
                            );
                        }
                    }
                    break;

                case 'App\Models\Membership':
                    foreach ($for_insert as $insert_item) {
                        foreach ($insert_item as $k => $item) {
                            foreach ($item as $key => $value) {
                                if (isset($item["member_reference"]) && $item["member_reference"] != "") {

                                    if (isset($item["date_awarded"])) {
                                        if (str_contains($item["date_awarded"], "/")) {
                                            $item["date_awarded"] = Carbon::createFromFormat('d/m/Y', $item["date_awarded"])->format('Y-m-d');
                                        } else {
                                            $item["date_awarded"] = Carbon::parse($item["date_awarded"])->format('Y-m-d');
                                        }
                                    }

                                    if (isset($item["membership_validity"])) {
                                        if (str_contains($item["membership_validity"], "/")) {
                                            $item["membership_validity"] = Carbon::createFromFormat('d/m/Y', $item["membership_validity"])->format('Y-m-d');
                                        } else {
                                            $item["membership_validity"] = Carbon::parse($item["membership_validity"])->format('Y-m-d');
                                        }
                                    }

                                    if ($value == "") {
                                        unset($item[$key]);
                                    }
                                } else {
                                    session()->flash('message', 'Member reference is mandatory! Please check csv and try again.');

                                    return redirect($request->input('redirect'));
                                }
                            }
                            array_push($for_insert_without_blanks, $item);
                        }
                    }
                    $for_insert_without_blanks = array_chunk($for_insert_without_blanks, 100);
                    foreach ($for_insert_without_blanks as $insert_item) {
                        foreach ($insert_item as $item) {
                            $model::updateOrCreate(
                                ['member_reference' => $item['member_reference']],
                                array_diff_key($item, array_flip(["member_reference"]))
                            );
                        }
                    }
                    break;

                case 'App\Models\Ada':
                    foreach ($for_insert as $insert_item) {
                        foreach ($insert_item as $k => $item) {
                            foreach ($item as $key => $value) {
                                if (isset($item["award_reference"]) && $item["award_reference"] != "") {
                                    if (isset($item["date_awarded"])) {
                                        if (str_contains($item["date_awarded"], "/")) {
                                            $item["date_awarded"] = Carbon::createFromFormat('d/m/Y', $item["date_awarded"])->format('Y-m-d');
                                        } else {
                                            $item["date_awarded"] = Carbon::parse($item["date_awarded"])->format('Y-m-d');
                                        }
                                    }
                                    if (isset($item["award_validity"])) {
                                        if (str_contains($item["award_validity"], "/")) {
                                            $item["award_validity"] = Carbon::createFromFormat('d/m/Y', $item["award_validity"])->format('Y-m-d');
                                        } else {
                                            $item["award_validity"] = Carbon::parse($item["award_validity"])->format('Y-m-d');
                                        }
                                    }

                                    if ($value == "") {
                                        unset($item[$key]);
                                    }
                                } else {
                                    session()->flash('message', 'Member reference is mandatory! Please check csv and try again.');

                                    return redirect($request->input('redirect'));
                                }
                            }
                            array_push($for_insert_without_blanks, $item);
                        }
                    }
                    $for_insert_without_blanks = array_chunk($for_insert_without_blanks, 100);
                    foreach ($for_insert_without_blanks as $insert_item) {
                        foreach ($insert_item as $item) {
                            $model::updateOrCreate(
                                ['award_reference' => $item['award_reference']],
                                array_diff_key($item, array_flip(["award_reference"]))
                            );
                        }
                    }
                    break;

                default:
                    foreach ($for_insert as $insert_item) {
                        $model::insert($insert_item);
                    }
                    break;
            }

            $rows  = count($insert);
            $table = Str::plural($modelName);

            File::delete($path);

            session()->flash('message', trans('global.app_imported_rows_to_table', ['rows' => $rows, 'table' => $table]));

            return redirect($request->input('redirect'));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function parseCsvImport(Request $request)
    {
        $file = $request->file('csv_file');
        $request->validate([
            'csv_file' => 'mimes:csv,txt',
        ]);

        $path      = $file->path();
        $hasHeader = $request->input('header', false) ? true : false;

        $reader  = new SpreadsheetReader($path);
        $headers = $reader->current();
        $lines   = [];

        $i = 0;
        while ($reader->next() !== false && $i < 5) {
            $lines[] = $reader->current();
            ++$i;
        }

        $filename = Str::random(10) . '.csv';
        $file->storeAs('csv_import', $filename);

        $modelName     = $request->input('model', false);
        $fullModelName = 'App\\Models\\' . $modelName;

        $model     = new $fullModelName();
        $fillables = $model->getFillable();

        $redirect = url()->previous();

        $routeName = 'admin.' . strtolower(Str::plural(Str::kebab($modelName))) . '.processCsvImport';

        return view('csvImport.parseInput', compact('headers', 'filename', 'fillables', 'hasHeader', 'modelName', 'lines', 'redirect', 'routeName'));
    }
}
