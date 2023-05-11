<?php

namespace App\Http\Livewire\Queue;

use App\Models\Diagnosis;
use App\Models\Lab;
use App\Models\MedicalRecord;
use App\Models\Pregnantmom;
use App\Models\Queue;
use App\Models\Gravida;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Process extends Component
{
    public $queue;
    public $listDiagnosa = [];
    public $listDrug = [];
    public $listLab = [];

    public $height;
    public $allergy;
    public $weight;
    public $blood_pressure;
    public $color_blind;
    public $blood;
    public $respiration;
    public $pulse;
    public $temperature;
    public $disability;
    public $anamnesis;
    public $main_complaint;
    public $history_disease;

    public $anak_ke;
    public $hpht;
    public $pregnant_age;
    public $lila;
    public $hpl;
    public $tfu;
    public $djj;
    public $immunization_tt;
    public $description;
    public $complaint;

        protected $listeners = [
        'diagnosaAdded',
        'labAdded',
        'drugAdded'
    ];


    public function rules()
    {
        return [
            'height' => 'required',
            'weight' => 'required',
            'blood_pressure' => 'required',
            'color_blind' => 'required',
            'blood' => 'required',
            'respiration' => 'required',
            'pulse' => 'required',
            'history_disease' => 'required',
            'temperature' => 'required',
            'disability' => 'required',
            'anamnesis' => 'required',
        ];
    }

    public  function mount(Queue $queue)
    {
        $this->queue = $queue;
        $this->allergy = $this->queue->patient->allergy;
        $this->main_complaint = $this->queue->main_complaint;
    }
    public function render()
    {
        return view('livewire.queue.process');
    }

    public function addDiagnosa()
    {
        $this->dispatchBrowserEvent('show-model', [
            'id' => 'diagnosa'
        ]);
    }
    public function addLab()
    {
        $this->dispatchBrowserEvent('show-model', [
            'id' => 'lab'
        ]);
    }
    public function addDrug()
    {
        $this->dispatchBrowserEvent('show-model', [
            'id' => 'drug'
        ]);
    }
    public function deleteLab($id)
    {
        unset($this->listLab[$id]);
        $this->listLab = array_values($this->listLab);
    }

    public function deleteDiagnosa($id)
    {
        unset($this->listDiagnosa[$id]);
        $this->listDiagnosa = array_values($this->listDiagnosa);
    }
    public function deleteDrug($id)
    {
        unset($this->listDrug[$id]);
        $this->listDrug = array_values($this->listDrug);
    }


    public function diagnosaAdded(Diagnosis $diagnosis)
    {
        if (!in_array($diagnosis, $this->listDiagnosa)) {
            $this->listDiagnosa[] = [
                "diagnosa" => $diagnosis,
                "description" => "",
            ];
        }
    }

    public function labAdded(Lab $lab)
    {
        if (!in_array($lab, $this->listLab)) {
            $this->listLab[] = [
                "lab" => $lab,
                "result" => "",
            ];
            $lab = $lab->paginate(5);
        }
    }

    public function drugAdded(\App\Models\Drug $drug)
    {
        if (!in_array($drug, $this->listDrug)) {
            $this->listDrug[] = [
                "drug" => $drug,
                "quantity" => 1,
                "instruction" => ""
            ];
        }
    }

    // TODO:: Create queue update function
    public function update()
    {
        # code...
    }

    public function save(Request $request)
    {
        // $this->validate();
        try {
            if (Auth::user()->role == "dokter") {
                $medical_record = MedicalRecord::create([
                    'anamnesis' => $this->anamnesis,
                    'physical_test' => json_encode(
                        [
                            "height" => $this->height,
                            "weight" => $this->weight,
                            "blood" => $this->blood,
                            "blood_pressure" => $this->blood_pressure,
                            "color_blind" => $this->color_blind,
                            "respiration" => $this->respiration,
                            "pulse" => $this->pulse,
                            "history_disease" => $this->history_disease,
                            "disability" => $this->disability,
                            "temperature" => $this->temperature
                        ]
                    ),
                    'main_complaint' => $this->main_complaint,
                    'doctor_id' => $this->queue->doctor->id,
                    'patient_id' => $this->queue->patient->id,
                ]);
            } else if (Auth::user()->role == "bidan") {

                $cek = Gravida::where("patien_id", $request->patient_id)->count();

                if ($cek == 0) {
                    $gravida = Gravida::create([

                        "patien_id" => $request->patient_id,
                        "bidan_id" => $request->doctor_id,
                        "hpl" => "Senin"

                    ]);
                }

                $kondisi = Gravida::where("patien_id", $request->patient_id)->first();

                if (empty($kondisi)) {
                    $gravida_id = $request->gravida_id;
                } else {
                    $gravida_id = $kondisi->id;
                }

                $pregnantmoms = Pregnantmom::create([
                    "gravida_id" => $gravida_id,
                    "anak_ke" => $request->anak_ke,
                    "hpht" => $request->hpht,
                    "pregnant_age" => $request->pregnant_age,
                    "lila" => $request->lila,
                    "weight" => $request->weight,
                    "blood_pressure" => $request->blood_pressure,
                    "tfu" => $request->tfu,
                    "djj" => $request->djj,
                    "immunization_tt" => $request->immunization_tt,
                    "description" => $request->description,
                    "complaint" => $request->complaint
                ]);

            }
            foreach ($this->listDiagnosa as $diagnosa) {
                $medical_record->diagnoses()->attach($diagnosa["diagnosa"]["id"], [
                    "description" => $diagnosa["description"]
                ]);
            }
            foreach ($this->listLab as $lab) {
                $medical_record->labs()->attach($lab["lab"]["id"], [
                    "result" => $lab["result"]
                ]);
            }

            foreach ($this->listDrug as $drug) {
                $medical_record->drugs()->attach($drug["drug"]["id"], [
                    "quantity" => $drug["quantity"],
                    "instruction" => $drug["instruction"]
                ]);
            }

            if (Auth::user()->role == "dokter") {
                $this->queue->update([
                    'has_check' => true,
                    'medical_record_id' => $medical_record->id,
                ]);
                $this->redirectRoute('queue.index');
            } else if (Auth::user()->role == "bidan") {
                Queue::where("patient_id", $request->patient_id)->update([
                    "has_check" => true
                ]);
                return redirect("/antrian");
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
