<?php

use App\Mouse;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(PrivilegeTableSeeder::class);
        $this->call(Privilege_UserTableSeeder::class);
        $this->call(ColonyTableSeeder::class);
        $this->call(TagTableSeeder::class);
        $this->call(TissueTableSeeder::class);
        $this->call(StorageTableSeeder::class);
        $this->call(CompartmentTableSeeder::class);
        $this->call(ShelfTableSeeder::class);
        $this->call(MouseTableSeeder::class);
        $this->call(WeightTableSeeder::class);
        $this->call(Blood_PressureTableSeeder::class);
        $this->call(TreatmentTableSeeder::class);
        $this->call(CageTableSeeder::class);
        $this->call(SurgeryTableSeeder::class);
        $this->call(Mouse_SurgeryTableSeeder::class);
        $this->call(BoxTableSeeder::class);
        $this->call(Mouse_StoragesTableSeeder::class);
        $this->call(Mouse_TagTableSeeder::class);
        $this->call(MouseTreatmentsTable::class);
        $this->call(ExperimentSeeder::class);
    }
}

class ExperimentSeeder extends seeder{
    public function run(){
        DB::table('experiments')->insert([
            'id' => 1,
            'title' => 'N/A',
            'active' => true
        ]);

        DB::table('experiments')->insert([
            'id' => 2,
            'title' => 'Patch Clamp',
            'active' => false
        ]);

        DB::table('experiments')->insert([
            'id' => 3,
            'title' => 'Optical Mapping',
            'active' => true
        ]);
    }
}

class MouseTreatmentsTable extends Seeder
{
    public function run(){
        DB::table('mouse_treatment')->insert([
            'mouse_id' => 1,
            'treatment_id' => 1,
            'dosage' => 1.05
        ]);

        DB::table('mouse_treatment')->insert([
            'mouse_id' => 2,
            'treatment_id' => 1,
            'dosage' => 1.05
        ]);

        DB::table('mouse_treatment')->insert([
            'mouse_id' => 3,
            'treatment_id' => 1,
            'dosage' => 1.05
        ]);
    }
}

class UserTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->insert([
            'first_name' => "Martin",
            'last_name' => "Mackasey",
            'email' => "mmackasey@gmail.com",
            'admin' => true,
            'active' => true,
            'new_password' => false,
            'student_id' => "d0000000",
            'phone' => "9025555555",
            'password' => Hash::make("password"),
        ]);
        DB::table('users')->insert([
            'first_name' => "Devon",
            'last_name' => "Turner",
            'email' => "devonj.turner@gmail.com",
            'admin' => true,
            'active' => true,
            'new_password' => false,
            'student_id' => "W0204891",
            'phone' => "9028188414",
            'password' => Hash::make("password"),
        ]);
        DB::table('users')->insert([
            'first_name' => "Scott",
            'last_name' => "Rafael",
            'email' => "squiggs.rafael@gmail.com",
            'admin' => true,
            'active' => true,
            'new_password' => false,
            'student_id' => "w0218584",
            'phone' => "9024418780",
            'password' => Hash::make("password"),
        ]);
        DB::table('users')->insert([
            'first_name' => "Traverse",
            'last_name' => "Davies",
            'email' => "traverse.davies@nscc.ca",
            'admin' => true,
            'active' => true,
            'new_password' => false,
            'student_id' => "w0297372",
            'phone' => "9025551234",
            'password' => Hash::make("!Summer2"),
        ]);
    }
}

class PrivilegeTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('privileges')->insert([
            'name' => "Administrator",
        ]);
        DB::table('privileges')->insert([
            'name' => "Technician",
        ]);
        DB::table('privileges')->insert([
            'name' => "Standard",
        ]);
    }
}

class Privilege_UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('privilege_user')->insert([
            'user_id' => 1,
            'privilege_id' => 1,
        ]);

        DB::table('privilege_user')->insert([
            'user_id' => 1,
            'privilege_id' => 2,
        ]);

        DB::table('privilege_user')->insert([
            'user_id' => 1,
            'privilege_id' => 3,
        ]);

        DB::table('privilege_user')->insert([
            'user_id' => 2,
            'privilege_id' => 1,
        ]);

        DB::table('privilege_user')->insert([
            'user_id' => 2,
            'privilege_id' => 2,
        ]);

        DB::table('privilege_user')->insert([
            'user_id' => 2,
            'privilege_id' => 3,
        ]);

        DB::table('privilege_user')->insert([
            'user_id' => 3,
            'privilege_id' => 1,
        ]);

        DB::table('privilege_user')->insert([
            'user_id' => 3,
            'privilege_id' => 2,
        ]);

        DB::table('privilege_user')->insert([
            'user_id' => 3,
            'privilege_id' => 3,
        ]);
    }
}

class ColonyTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('colonies')->insert([
            'name' => 'NPR-C',
            'external' => false,
            'active' => true
        ]);

        DB::table('colonies')->insert([
            'name' => 'Akita',
            'external' => false,
            'active' => true
        ]);

        DB::table('colonies')->insert([
            'name' => 'NPR-B',
            'external' => false,
            'active' => true
        ]);

        DB::table('colonies')->insert([
            'name' => 'GFP',
            'external' => false,
            'active' => false
        ]);

        DB::table('colonies')->insert([
            'name' => 'Jackson River',
            'external' => true,
            'active' => true
        ]);
    }
}

class CageTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('cages')->insert([
            'male' => 1,
            'female_one' => 2,
            'female_two' => 3,
            'female_three' => 4,
            'room_num' => '78'
        ]);
    }
}

class TreatmentTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('treatments')->insert([
            'title' => 'Ang-II',
            'active' => true
        ]);

        DB::table('treatments')->insert([
            'title' => 'saline',
            'active' => true
        ]);

        DB::table('treatments')->insert([
            'title' => 'Ang-II + cANF',
            'active' => true
        ]);
    }
}

class WeightTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('weights')->insert([
            'weight' => 30.1,
            'weighed_on' => '2012-01-16',
            'mouse_id' => 1,
            'created_at' => Carbon::now('America/Halifax')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now('America/Halifax')->format('Y-m-d H:i:s')
        ]);

        DB::table('weights')->insert([
            'weight' => 26.4,
            'weighed_on' => '2012-01-16',
            'mouse_id' => 2,
            'created_at' => Carbon::now('America/Halifax')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now('America/Halifax')->format('Y-m-d H:i:s')
        ]);

        DB::table('weights')->insert([
            'weight' => 27.1,
            'weighed_on' => '2012-01-16',
            'mouse_id' => 3,
            'created_at' => Carbon::now('America/Halifax')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now('America/Halifax')->format('Y-m-d H:i:s')
        ]);

        DB::table('weights')->insert([
            'weight' => 24.7,
            'weighed_on' => '2012-01-16',
            'mouse_id' => 4,
            'created_at' => Carbon::now('America/Halifax')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now('America/Halifax')->format('Y-m-d H:i:s')
        ]);
    }
}

class Blood_PressureTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('blood_pressures')->insert([
            'systolic' => 'null',
            'diastolic' => 'null',
            'taken_on' => '2012-01-16',
            'mouse_id' => 1
        ]);

        DB::table('blood_pressures')->insert([
            'systolic' => 'null',
            'diastolic' => 'null',
            'taken_on' => '2012-01-16',
            'mouse_id' => 2
        ]);

        DB::table('blood_pressures')->insert([
            'systolic' => 'null',
            'diastolic' => 'null',
            'taken_on' => '2012-01-16',
            'mouse_id' => 3
        ]);

        DB::table('blood_pressures')->insert([
            'systolic' => 'null',
            'diastolic' => 'null',
            'taken_on' => '2012-01-16',
            'mouse_id' => 4
        ]);
    }
}

class TagTableSeeder extends Seeder
{

    public function run()
    {
        for($i = 0; $i < 1000; $i++) {

            $i = str_pad($i, 3, '00', STR_PAD_LEFT);

            DB::table('tags')->insert([
                'tag_num' => $i,
                'lost_tag' => false
            ]);
        }
    }
}

class TissueTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('tissues')->insert([
            'name' => 'Full Atrial',
            'active' => true
        ]);

        DB::table('tissues')->insert([
            'name' => 'RAA',
            'active' => true
        ]);

        DB::table('tissues')->insert([
            'name' => 'LAA',
            'active' => true
        ]);

        DB::table('tissues')->insert([
            'name' => 'SAN',
            'active' => false
        ]);

        DB::table('tissues')->insert([
            'name' => 'RA',
            'active' => true
        ]);

        DB::table('tissues')->insert([
            'name' => 'Vent.',
            'active' => true
        ]);

        DB::table('tissues')->insert([
            'name' => 'LV',
            'active' => true
        ]);

        DB::table('tissues')->insert([
            'name' => 'RV',
            'active' => true
        ]);

        DB::table('tissues')->insert([
            'name' => 'Vent Apex',
            'active' => true
        ]);

        DB::table('tissues')->insert([
            'name' => 'Whole Heart',
            'active' => true
        ]);
    }
}

class StorageTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('storages')->insert([
            'type' => true,
            'identifier' => '1'
        ]);

        DB::table('storages')->insert([
            'type' => false,
            'identifier' => '1'
        ]);
    }
}

class CompartmentTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('compartments')->insert([
            'description' => 'Top',
            'storage_id' => 1
        ]);

        DB::table('compartments')->insert([
            'description' => 'Bottom',
            'storage_id' => 1
        ]);
    }
}

class ShelfTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('shelves')->insert([
            'description' => 'Top',
            'compartment_id' => 1,
        ]);

        DB::table('shelves')->insert([
            'description' => 'Bottom',
            'compartment_id' => 1,
        ]);

        DB::table('shelves')->insert([
            'description' => 'Top',
            'compartment_id' => 2,
        ]);

        DB::table('shelves')->insert([
            'description' => 'Bottom',
            'compartment_id' => 2,
        ]);
    }
}

class BoxTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('boxes')->insert([
            'column' => "A",
            'row' =>  1,
            'box' =>  1,
            'shelf_id' => 1,
            'capacity' => '81'
        ]);

        DB::table('boxes')->insert([
            'column' => "A",
            'row' =>  1,
            'box' =>  2,
            'shelf_id' => 1,
            'capacity' => '81'
        ]);
    }
}

class MouseTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('mice')->insert([
            'colony_id' => 1,
            'source' => 'In house',
            'reserved_for' => 1,
            'sex' => 1,
            'geno_type_a' => 1,
            'geno_type_b' => 1,
            'father' => null,
            'mother_one' => null,
            'mother_two' => null,
            'mother_three' => null,
            'birth_date' => '2012-01-02',
            'wean_date' => '2012-01-29',
            'end_date' => '2012-02-28',
            'is_alive' => 1,
            'sick_report' => false
        ]);

        DB::table('mice')->insert([
            'colony_id' => 1,
            'source' => 'In house',
            'reserved_for' => 1,
            'sex' => 0,
            'geno_type_a' => 1,
            'geno_type_b' => 0,
            'father' => null,
            'mother_one' => null,
            'mother_two' => null,
            'mother_three' => null,
            'birth_date' => '2012-01-02',
            'wean_date' => '2012-01-29',
            'end_date' => null,
            'is_alive' => 1,
            'sick_report' => false
        ]);

        DB::table('mice')->insert([
            'colony_id' => 1,
            'source' => 'In house',
            'reserved_for' => 1,
            'sex' => 0,
            'geno_type_a' => 0,
            'geno_type_b' => 0,
            'father' => null,
            'mother_one' => null,
            'mother_two' => null,
            'mother_three' => null,
            'birth_date' => '2012-01-02',
            'wean_date' => '2012-01-29',
            'end_date' => null,
            'is_alive' => 1,
            'sick_report' => false
        ]);

        DB::table('mice')->insert([
            'colony_id' => 1,
            'source' => 'In house',
            'reserved_for' => 1,
            'sex' => 0,
            'geno_type_a' => 1,
            'geno_type_b' => 1,
            'father' => null,
            'mother_one' => null,
            'mother_two' => null,
            'mother_three' => null,
            'birth_date' => '2012-01-02',
            'wean_date' => '2012-01-29',
            'end_date' => null,
            'is_alive' => 1,
            'sick_report' => true
        ]);

        $mouse = Mouse::find(1);
        $mouse->father = 1;
        $mouse->mother_one = 2;
        $mouse->save();

        $mouse = Mouse::find(2);
        $mouse->father = 1;
        $mouse->mother_one = 2;
        $mouse->save();

        $mouse = Mouse::find(3);
        $mouse->father = 1;
        $mouse->mother_one = 2;
        $mouse->save();

        $mouse = Mouse::find(4);
        $mouse->father = 1;
        $mouse->mother_one = 2;
        $mouse->save();


    }
}

class SurgeryTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('surgeries')->insert([
            'user_id' => 1,
            'title' => 'Martin\'s Cardiac H2',
            'scheduled_date' => '2012-01-02',
            'end_date' => '2012-01-31'
        ]);

        DB::table('surgeries')->insert([
            'user_id' => 1,
            'title' => 'BEEEEYYYYYZZZZAAAAAAADDDD',
            'scheduled_date' => '2012-01-02',
            'end_date' => '2012-01-31'
        ]);
    }
}


class Mouse_SurgeryTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('mouse_surgery')->insert([
            'mouse_id' => 1,
            'surgery_id' => 1
        ]);

        DB::table('mouse_surgery')->insert([
            'mouse_id' => 2,
            'surgery_id' => 2
        ]);
    }
}

class Mouse_StoragesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('mouse_storages')->insert([
            'mouse_id' => 1,
            'tissue_id' => 1,
            'box_id' => 1,
            'user_id' => 1,
            'extraction_date' => '2012-01-31'
        ]);

        DB::table('mouse_storages')->insert([
            'mouse_id' => 2,
            'tissue_id' => 1,
            'box_id' => 1,
            'user_id' => 2,
            'extraction_date' => '2012-01-31'
        ]);
    }
}

class Mouse_TagTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('mouse_tag')->insert([
            'mouse_id' => 1,
            'tag_id' => 1
        ]);

        DB::table('mouse_tag')->insert([
            'mouse_id' => 2,
            'tag_id' => 2
        ]);

        DB::table('mouse_tag')->insert([
            'mouse_id' => 3,
            'tag_id' => 3
        ]);

        DB::table('mouse_tag')->insert([
            'mouse_id' => 4,
            'tag_id' => 4
        ]);

    }
}
