<?php
use Illuminate\Database\Seeder;
class RequestedDocumentsSeeder extends Seeder
{
    /**
     * Run the seeder.
     *
     * @return void
     */
    public function run()
    {
        DB::table('requested_documents')->truncate();
       
        $documents = [
            ['name' => 'Partnership deed or memorandum of article of association', 'name_ar' => 'صك الشراكة أو مذكرة التأسيس', 'type' =>'Local', 'required'=>1],
            ['name' => 'Audited balance sheet for the last year accompanied by report from an auditor', 'name_ar' => 'الميزانية العمومية المدققة للعام الماضي مصحوبة بتقرير من مدقق الحسابات', 'type' => 'Local', 'required'=>1],
            ['name' => 'Commercial registration certificate', 'name_ar' => 'شهادة السجل التجاري', 'type'=>'Local', 'required'=>1],
            ['name' => 'VAT certificate', 'name_ar' => 'شهادة ضريبة القيمة المضافة', 'type' =>'Local', 'required'=>1],
            ['name' => 'Social insurance certificate', 'name_ar' => 'شهادة التأمينات الاجتماعية', 'type' =>'Local', 'required'=>1],
            ['name' => 'Membership of the Egyptian federation for construction and building certificate', 'name_ar' => 'عضوية الاتحاد المصري للبناء وشهادة البناء', 'type' =>'Local', 'required'=>1],
            ['name' => 'ISO certificates ', 'name_ar' => 'شهادات ISO ', 'type' =>'Local', 'required'=> 0],
            ['name' => 'Agent authorization letter for the company agreement', 'name_ar' => 'خطاب تفويض الوكيل لاتفاقية الشركة', 'type' =>'Local', 'required'=>1],
            ['name' => 'TAX Card', 'name_ar' => 'البطاقه الضريبيه', 'type' =>'Local', 'required'=>1],
            
            
            
            
            
            ['name' => 'Partnership deed or memorandum of article of association', 'name_ar' => 'صك الشراكة أو مذكرة التأسيس', 'type' =>'Foreign', 'required'=>1],
            ['name' => 'Audited balance sheet for the last year accompanied by report from an auditor', 'name_ar' => 'الميزانية العمومية المدققة للعام الماضي مصحوبة بتقرير من مدقق الحسابات', 'type' =>'Foreign', 'required'=>1],
            ['name' => 'Commercial registration certificate', 'name_ar' => 'شهادة السجل التجاري', 'type' =>'Foreign', 'required'=>1],
            ['name' => 'VAT certificate', 'name_ar' => 'شهادة ضريبة القيمة المضافة', 'type' =>'Foreign', 'required'=>1],
            ['name' => 'Social insurance certificate', 'name_ar' => 'شهادة التأمينات الاجتماعية', 'type' =>'Foreign', 'required'=>1],
            ['name' => 'Membership of the Egyptian federation for construction and building certificate', 'name_ar' => 'عضوية الاتحاد المصري للبناء وشهادة البناء', 'type' =>'Foreign', 'required'=>1],
            ['name' => 'ISO certificates ', 'name_ar' => 'شهادات ISO ', 'type' =>'Foreign', 'required'=>0],
            ['name' => 'Agent authorization letter for the company agreement', 'name_ar' => 'خطاب تفويض الوكيل لاتفاقية الشركة', 'type' =>'Foreign', 'required'=>1],
            ['name' => 'Introduction letter specifying the area of activities', 'name_ar' => 'خطاب مقدمة يحدد مجال الأنشطة', 'type' =>'Foreign', 'required'=>1],
            ['name' => 'Authorization letter that explains your agent in Egypt (if exists), OR A company agreement or contract agreement between you and your agent', 'name_ar' => 'خطاب تفويض يشرح وكيلك في مصر (إن وجد) ، أو اتفاقية شركة أو اتفاقية عقد بينك وبين وكيلك', 'type' =>'Foreign', 'required'=>1],
            ['name' => 'A catalogue for your past projects', 'name_ar' => 'كتالوج لمشاريعك الماضية', 'type' =>'Foreign', 'required'=>1],
            ['name' => 'TAX Card', 'name_ar' => 'البطاقه الضريبيه', 'type' =>'Foreign', 'required'=>1],
            
        ];

        DB::table('requested_documents')->insert($documents);
    }
}


