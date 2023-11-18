<?php

namespace App\Http\Controllers\Admin;

use App\Constants\LanguageConst;
use App\Constants\SiteSectionConst;
use App\Http\Controllers\Controller;
use App\Models\Admin\Language;
use App\Models\Admin\SiteSections;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;

class SetupSectionsController extends Controller
{
    protected $languages;

    public function __construct()
    {
        $this->languages = Language::get();
    }

    /**
     * Register Sections with their slug
     * @param string $slug
     * @param string $type
     * @return string
     */
    public function section($slug,$type) {
        $sections = [
            'banner'            => [
                'view'          => "bannerView",
                'update'        => "bannerUpdate",
                'itemStore'     => "bannerItemStore",
                'itemUpdate'    => "bannerItemUpdate",
                'itemDelete'    => "bannerItemDelete",
            ],
            'solutions'  => [
                'view'      => "solutionView",
                'update'    => "solutionUpdate",
                'itemStore'     => "solutionItemStore",
                'itemUpdate'    => "solutionItemUpdate",
                'itemDelete'    => "solutionItemDelete",
            ],
            'monitoring'  => [
                'view'      => "monitoringView",
                'update'    => "monitoringUpdate",
            ],
            'best-item'  => [
                'view'      => "bestItemView",
                'update'    => "bestItemUpdate",
            ],
            'latest-item'  => [
                'view'      => "latestItemView",
                'update'    => "latestItemUpdate",
            ],
            'glance'  => [
                'view'          => "glanceView",
                'update'        => "glanceUpdate",
                'itemUpdate'    => "glanceItemUpdate",
            ],
            'intro'  => [
                'view'          => "introView",
                'update'        => "introUpdate",
            ],
        ];

        if(!array_key_exists($slug,$sections)) abort(404);
        if(!isset($sections[$slug][$type])) abort(404);
        $next_step = $sections[$slug][$type];
        return $next_step;
    }

    /**
     * Method for getting specific step based on incomming request
     * @param string $slug
     * @return method
     */
    public function sectionView($slug) {
        $section = $this->section($slug,'view');
        return $this->$section($slug);
    }

    /**
     * Method for distribute store method for any section by using slug
     * @param string $slug
     * @param \Illuminate\Http\Request  $request
     * @return method
     */
    public function sectionItemStore(Request $request, $slug) {
        $section = $this->section($slug,'itemStore');
        return $this->$section($request,$slug);
    }

    /**
     * Method for distribute update method for any section by using slug
     * @param string $slug
     * @param \Illuminate\Http\Request  $request
     * @return method
     */
    public function sectionItemUpdate(Request $request, $slug) {
        $section = $this->section($slug,'itemUpdate');
        return $this->$section($request,$slug);
    }

    /**
     * Method for distribute delete method for any section by using slug
     * @param string $slug
     * @param \Illuminate\Http\Request  $request
     * @return method
     */
    public function sectionItemDelete(Request $request,$slug) {
        $section = $this->section($slug,'itemDelete');
        return $this->$section($request,$slug);
    }

    /**
     * Method for distribute update method for any section by using slug
     * @param string $slug
     * @param \Illuminate\Http\Request  $request
     * @return method
     */
    public function sectionUpdate(Request $request,$slug) {
        $section = $this->section($slug,'update');
        return $this->$section($request,$slug);
    }

    /**
     * Mehtod for show banner section page
     * @param string $slug
     * @return view
     */
    public function bannerView($slug) {
        $page_title = "Banner Section";
        $section_slug = Str::slug(SiteSectionConst::BANNER_SECTION);
        $data = SiteSections::getData($section_slug)->first();
        $languages = $this->languages;

        return view('admin.sections.setup-sections.banner-section',compact(
            'page_title',
            'data',
            'languages',
            'slug',
        ));
    }

    /**
     * Mehtod for update banner section information
     * @param string $slug
     * @param \Illuminate\Http\Request  $request
     */
    public function bannerUpdate(Request $request,$slug) {
        $basic_field_name   = [
            'title'         => "required|string|max:100",
            'heading'       => "required|string|max:100",
            'sub_heading'   => "required|string|max:255",
            'button_name'   => "required|string|max:50",
        ];

        $slug = Str::slug(SiteSectionConst::BANNER_SECTION);
        $section = SiteSections::where("key",$slug)->first();

        if($section      != null){
            $data         = json_decode(json_encode($section->value),true);
        }else{
            $data         = [];
        }

        $validator  = Validator::make($request->all(),[
            'image'             => "nullable|image|mimes:jpg,png,svg,webp|max:10240",
            'button_image'             => "nullable|image|mimes:jpg,png,svg,webp|max:10240",
            'button_link'       => "required|string|url|max:255",
        ]);

        if($validator->fails()) return back()->withErrors($validator->errors())->withInput();
        $validated = $validator->validate();

        $data['image']          = $section->value->image ?? "";
        $data['button_image']   = $section->value->button_image ?? "";

        $data['button_link']    = $validated['button_link'];

        if($request->hasFile("image")) {
            $data['image']              = $this->imageValidate($request,"image",$section->value->image ?? null);
        }
        if($request->hasFile("button_image")){
            $data['button_image']       = $this->imageValidate($request,"button_image",$section->value->button_image ?? null);
        }

        $data['language']  = $this->contentValidate($request,$basic_field_name);
        $update_data['value']  = $data;
        $update_data['key']    = $slug;
        
        try{
            SiteSections::updateOrCreate(['key' => $slug],$update_data);
        }catch(Exception $e) {
            return back()->with(['error' => ['Something went wrong! Please try again.']]);
        }

        return back()->with(['success' => ['Section updated successfully!']]);
    }
    /**
     * Mehtod for show solutions section page
     * @param string $slug
     * @return view
     */
    public function solutionView($slug) {
        $page_title = "Solutions Section";
        $section_slug = Str::slug(SiteSectionConst::SOLUTIONS_SECTION);
        $data = SiteSections::getData($section_slug)->first();
        $languages = $this->languages;

        return view('admin.sections.setup-sections.solutions-section',compact(
            'page_title',
            'data',
            'languages',
            'slug',
        ));
    }

    /**
     * Mehtod for update solutions section information
     * @param string $slug
     * @param \Illuminate\Http\Request  $request
     */
    public function solutionUpdate(Request $request,$slug) {
        $basic_field_name = ['heading' => "required|string|max:100",'sub_heading' => "required|string|max:255"];

        $slug = Str::slug(SiteSectionConst::SOLUTIONS_SECTION);
        $section = SiteSections::where("key",$slug)->first();

        if($section != null) {
            $section_data = json_decode(json_encode($section->value),true);
        }else {
            $section_data = [];
        }

        $section_data['language']  = $this->contentValidate($request,$basic_field_name);

        $update_data['key']    = $slug;
        $update_data['value']  = $section_data;

        try{
            SiteSections::updateOrCreate(['key' => $slug],$update_data);
        }catch(Exception $e) {
            return back()->with(['error' => ['Something went wrong! Please try again.']]);
        }

        return back()->with(['success' => ['Section updated successfully!']]);
    }

    /**
     * Mehtod for store solution item
     * @param string $slug
     * @param \Illuminate\Http\Request  $request
     */
    public function solutionItemStore(Request $request,$slug) {
        $basic_field_name = [
            'title'     => "required|string|max:255",
            'social_icon'   => "required|string|max:100",
            'link'          => "required|string|url|max:255",
        ];

        $language_wise_data = $this->contentValidate($request,$basic_field_name,"solution-add");
        if($language_wise_data instanceof RedirectResponse) return $language_wise_data;
        $slug = Str::slug(SiteSectionConst::SOLUTIONS_SECTION);
        $section = SiteSections::where("key",$slug)->first();

        if($section != null) {
            $section_data = json_decode(json_encode($section->value),true);
        }else {
            $section_data = [];
        }
        $unique_id = uniqid();

        $section_data['items'][$unique_id]['language'] = $language_wise_data;
        $section_data['items'][$unique_id]['id'] = $unique_id;
        $section_data['items'][$unique_id]['image'] = "";

        if($request->hasFile("image")) {
            $section_data['items'][$unique_id]['image'] = $this->imageValidate($request,"image",$section->value->items->image ?? null);
        }

        $update_data['key'] = $slug;
        $update_data['value']   = $section_data;

        try{
            SiteSections::updateOrCreate(['key' => $slug],$update_data);
        }catch(Exception $e) {
            return back()->with(['error' => ['Something went wrong! Please try again']]);
        }

        return back()->with(['success' => ['Section item added successfully!']]);
    }

    /**
     * Mehtod for update solution item
     * @param string $slug
     * @param \Illuminate\Http\Request  $request
     */
    public function solutionItemUpdate(Request $request,$slug) {
        $request->validate([
            'target'    => "required|string",
        ]);

        $basic_field_name = [
            'title_edit'     => "required|string|max:255",
            'social_icon_edit'   => "required|string|max:100",
            'link_edit'          => "required|string|url|max:255",
        ];

        $slug = Str::slug(SiteSectionConst::SOLUTIONS_SECTION);
        $section = SiteSections::getData($slug)->first();
        if(!$section) return back()->with(['error' => ['Section not found!']]);
        $section_values = json_decode(json_encode($section->value),true);
        if(!isset($section_values['items'])) return back()->with(['error' => ['Section item not found!']]);
        if(!array_key_exists($request->target,$section_values['items'])) return back()->with(['error' => ['Section item is invalid!']]);

        $request->merge(['old_image' => $section_values['items'][$request->target]['image'] ?? null]);

        $language_wise_data = $this->contentValidate($request,$basic_field_name,"solution-edit");
        if($language_wise_data instanceof RedirectResponse) return $language_wise_data;

        $language_wise_data = array_map(function($language) {
            return replace_array_key($language,"_edit");
        },$language_wise_data);

        $section_values['items'][$request->target]['language'] = $language_wise_data;

        if($request->hasFile("image")) {
            $section_values['items'][$request->target]['image']    = $this->imageValidate($request,"image",$section_values['items'][$request->target]['image'] ?? null);
        }

        try{
            $section->update([
                'value' => $section_values,
            ]);
        }catch(Exception $e) {
            return back()->with(['error' => ['Something went wrong! Please try again']]);
        }

        return back()->with(['success' => ['Information updated successfully!']]);
    }

    /**
     * Mehtod for delete solution item
     * @param string $slug
     * @param \Illuminate\Http\Request  $request
     */
    public function solutionItemDelete(Request $request,$slug) {
        $request->validate([
            'target'    => 'required|string',
        ]);
        $slug = Str::slug(SiteSectionConst::SOLUTIONS_SECTION);
        $section = SiteSections::getData($slug)->first();
        if(!$section) return back()->with(['error' => ['Section not found!']]);
        $section_values = json_decode(json_encode($section->value),true);
        if(!isset($section_values['items'])) return back()->with(['error' => ['Section item not found!']]);
        if(!array_key_exists($request->target,$section_values['items'])) return back()->with(['error' => ['Section item is invalid!']]);

        try{
            $image_link = get_files_path('site-section') . '/' . $section_values['items'][$request->target]['image'];
            unset($section_values['items'][$request->target]);
            delete_file($image_link);
            $section->update([
                'value'     => $section_values,
            ]);
        }catch(Exception $e) {
            return back()->with(['error' => ['Something went wrong! Please try again.']]);
        }

        return back()->with(['success' => ['Section item delete successfully!']]);
    }

    /**
     * Method for getting specific step based on incomming request
     * @param string $slug
     * @return method
     */
    public function monitoringView($slug) {
        $page_title = "Monitoring Section";
        $section_slug = Str::slug(SiteSectionConst::MONITORING_SECTION);
        $data = SiteSections::getData($section_slug)->first();
        $languages = $this->languages;

        return view('admin.sections.setup-sections.monitoring-section',compact(
            'page_title',
            'data',
            'languages',
            'slug',
        ));
    }

    /**
     * Mehtod for update monitoring section information
     * @param string $slug
     * @param \Illuminate\Http\Request  $request
     */
    public function monitoringUpdate(Request $request,$slug) {
        $basic_field_name = ['heading' => "required|string|max:100",'sub_heading' => "required|string|max:255",'button_name' => "required|string|max:50",'button_link' => "required|string|url|max:255", 'desc' => "required|string|max:2000"];

        $slug = Str::slug(SiteSectionConst::MONITORING_SECTION);
        $section = SiteSections::where("key",$slug)->first();
        if($request->hasFile("image")) {
            $data['image']      = $this->imageValidate($request,"image",$section->value->image ?? null);
        }

        $data['language']  = $this->contentValidate($request,$basic_field_name);
        $update_data['value']  = $data;
        $update_data['key']    = $slug;

        try{
            SiteSections::updateOrCreate(['key' => $slug],$update_data);
        }catch(Exception $e) {
            return back()->with(['error' => ['Something went wrong! Please try again.']]);
        }

        return back()->with(['success' => ['Section updated successfully!']]);
    }

    /**
     * Method for getting specific step based on incomming request
     * @param string $slug
     * @return method
     */
    public function bestItemView($slug) {
        $page_title = "Best Item Section";
        $section_slug = Str::slug(SiteSectionConst::BEST_ITEM_SECTION);
        $data = SiteSections::getData($section_slug)->first();
        $languages = $this->languages;

        return view('admin.sections.setup-sections.best-item-section',compact(
            'page_title',
            'data',
            'languages',
            'slug',
        ));
    }

    /**
     * Mehtod for update best item section information
     * @param string $slug
     * @param \Illuminate\Http\Request  $request
     */
    public function bestItemUpdate(Request $request,$slug) {
        $basic_field_name = ['heading' => "required|string|max:100",'sub_heading' => "required|string|max:255"];

        $slug = Str::slug(SiteSectionConst::BEST_ITEM_SECTION);
        $section = SiteSections::where("key",$slug)->first();

        $data['language']  = $this->contentValidate($request,$basic_field_name);
        $update_data['value']  = $data;
        $update_data['key']    = $slug;

        try{
            SiteSections::updateOrCreate(['key' => $slug],$update_data);
        }catch(Exception $e) {
            return back()->with(['error' => ['Something went wrong! Please try again.']]);
        }

        return back()->with(['success' => ['Section updated successfully!']]);
    }

    /**
     * Method for getting specific step based on incomming request
     * @param string $slug
     * @return method
     */
    public function latestItemView($slug) {
        $page_title = "Latest Item Section";
        $section_slug = Str::slug(SiteSectionConst::LATEST_ITEM_SECTION);
        $data = SiteSections::getData($section_slug)->first();
        $languages = $this->languages;

        return view('admin.sections.setup-sections.latest-item-section',compact(
            'page_title',
            'data',
            'languages',
            'slug',
        ));
    }

    /**
     * Mehtod for update best section information
     * @param string $slug
     * @param \Illuminate\Http\Request  $request
     */
    public function latestItemUpdate(Request $request,$slug) {
        $basic_field_name = ['heading' => "required|string|max:100",'sub_heading' => "required|string|max:255"];

        $slug = Str::slug(SiteSectionConst::LATEST_ITEM_SECTION);
        $section = SiteSections::where("key",$slug)->first();

        $data['language']  = $this->contentValidate($request,$basic_field_name);
        $update_data['value']  = $data;
        $update_data['key']    = $slug;

        try{
            SiteSections::updateOrCreate(['key' => $slug],$update_data);
        }catch(Exception $e) {
            return back()->with(['error' => ['Something went wrong! Please try again.']]);
        }

        return back()->with(['success' => ['Section updated successfully!']]);
    }

    /**
     * Method for getting specific step based on incomming request
     * @param string $slug
     * @return method
     */
    public function glanceView($slug) {
        $page_title = "Glance Section";
        $section_slug = Str::slug(SiteSectionConst::GLANCE_SECTION);
        $data = SiteSections::getData($section_slug)->first();
        $languages = $this->languages;

        return view('admin.sections.setup-sections.glance-section',compact(
            'page_title',
            'data',
            'languages',
            'slug',
        ));
    }

    /**
     * Mehtod for update glance section information
     * @param string $slug
     * @param \Illuminate\Http\Request  $request
     */
    public function glanceUpdate(Request $request) {
        $basic_field_name = ['heading' => "required|string|max:100",'sub_heading' => "required|string|max:255"];

        $slug = Str::slug(SiteSectionConst::GLANCE_SECTION);
        $section = SiteSections::where("key",$slug)->first();

        $data['language']  = $this->contentValidate($request,$basic_field_name);
        $update_data['value']  = $data;
        $update_data['key']    = $slug;

        try{
            SiteSections::updateOrCreate(['key' => $slug],$update_data);
        }catch(Exception $e) {
            return back()->with(['error' => ['Something went wrong! Please try again.']]);
        }

        return back()->with(['success' => ['Section updated successfully!']]);

    }

    /**
     * Mehtod for update glance section item information
     * @param string $slug
     * @param \Illuminate\Http\Request  $request
     */
    public function glanceItemUpdate(Request $request,$slug) {
        $request->validate([
            'target'    => "required|string",
        ]);

        $basic_field_name = [
            'title_edit'     => "required|string|max:255",
            'number_edit'    => "required|numeric",
        ];

        $slug = Str::slug(SiteSectionConst::GLANCE_SECTION);
        $section = SiteSections::getData($slug)->first();
        if(!$section) return back()->with(['error' => ['Section not found!']]);
        $section_values = json_decode(json_encode($section->value),true);
        if(!isset($section_values['items'])) return back()->with(['error' => ['Section item not found!']]);
        if(!array_key_exists($request->target,$section_values['items'])) return back()->with(['error' => ['Section item is invalid!']]);

        $request->merge(['old_image' => $section_values['items'][$request->target]['image'] ?? null]);

        $language_wise_data = $this->contentValidate($request,$basic_field_name,"solution-edit");
        if($language_wise_data instanceof RedirectResponse) return $language_wise_data;

        $language_wise_data = array_map(function($language) {
            return replace_array_key($language,"_edit");
        },$language_wise_data);

        $section_values['items'][$request->target]['language'] = $language_wise_data;

        if($request->hasFile("image")) {
            $section_values['items'][$request->target]['image']    = $this->imageValidate($request,"image",$section_values['items'][$request->target]['image'] ?? null);
        }

        try{
            $section->update([
                'value' => $section_values,
            ]);
        }catch(Exception $e) {
            return back()->with(['error' => ['Something went wrong! Please try again']]);
        }

        return back()->with(['success' => ['Information updated successfully!']]);
    }

    /**
     * Method for getting specific step based on incomming request
     * @param string $slug
     * @return method
     */
    public function introView($slug) {
        $page_title = "Intro Section";
        $section_slug = Str::slug(SiteSectionConst::INTRO_SECTION);
        $data = SiteSections::getData($section_slug)->first();
        $languages = $this->languages;

        return view('admin.sections.setup-sections.intro-section',compact(
            'page_title',
            'data',
            'languages',
            'slug',
        ));
    }

    public function introUpdate(Request $request,$slug) {
        $basic_field_name = ['heading' => "required|string|max:100",'sub_heading' => "required|string|max:255",'button_name' => "required|string|max:50",'button_link' => "required|string|url|max:255", 'video_link' => "required|string|url|max:255" , 'desc' => "required|string|max:2000"];

        $slug = Str::slug(SiteSectionConst::INTRO_SECTION);
        $section = SiteSections::where("key",$slug)->first();
        if($request->hasFile("image")) {
            $data['image']      = $this->imageValidate($request,"image",$section->value->image ?? null);
        }

        $data['language']  = $this->contentValidate($request,$basic_field_name);
        $update_data['value']  = $data;
        $update_data['key']    = $slug;

        try{
            SiteSections::updateOrCreate(['key' => $slug],$update_data);
        }catch(Exception $e) {
            return back()->with(['error' => ['Something went wrong! Please try again.']]);
        }

        return back()->with(['success' => ['Section updated successfully!']]);
    }

    /**
     * Method for get languages form record with little modification for using only this class
     * @return array $languages
     */
    public function languages() {
        $languages = Language::whereNot('code',LanguageConst::NOT_REMOVABLE)->select("code","name")->get()->toArray();
        $languages[] = [
            'name'      => LanguageConst::NOT_REMOVABLE_CODE,
            'code'      => LanguageConst::NOT_REMOVABLE,
        ];
        return $languages;
    }

    /**
     * Method for validate request data and re-decorate language wise data
     * @param object $request
     * @param array $basic_field_name
     * @return array $language_wise_data
     */
    public function contentValidate($request,$basic_field_name,$modal = null) {
        $languages = $this->languages();

        $current_local = get_default_language_code();
        $validation_rules = [];
        $language_wise_data = [];
        foreach($request->all() as $input_name => $input_value) {
            foreach($languages as $language) {
                $input_name_check = explode("_",$input_name);
                $input_lang_code = array_shift($input_name_check);
                $input_name_check = implode("_",$input_name_check);
                if($input_lang_code == $language['code']) {
                    if(array_key_exists($input_name_check,$basic_field_name)) {
                        $langCode = $language['code'];
                        if($current_local == $langCode) {
                            $validation_rules[$input_name] = $basic_field_name[$input_name_check];
                        }else {
                            $validation_rules[$input_name] = str_replace("required","nullable",$basic_field_name[$input_name_check]);
                        }
                        $language_wise_data[$langCode][$input_name_check] = $input_value;
                    }
                    break;
                } 
            }
        }
        if($modal == null) {
            $validated = Validator::make($request->all(),$validation_rules)->validate();
        }else {
            $validator = Validator::make($request->all(),$validation_rules);
            if($validator->fails()) {
                return back()->withErrors($validator)->withInput()->with("modal",$modal);
            }
            $validated = $validator->validate();
        }

        return $language_wise_data;
    }

    /**
     * Method for validate request image if have
     * @param object $request
     * @param string $input_name
     * @param string $old_image
     * @return boolean|string $upload
     */
    public function imageValidate($request,$input_name,$old_image) {
        if($request->hasFile($input_name)) {
            $image_validated = Validator::make($request->only($input_name),[
                $input_name         => "image|mimes:png,jpg,webp,jpeg,svg",
            ])->validate();

            $image = get_files_from_fileholder($request,$input_name);
            $upload = upload_files_from_path_dynamic($image,'site-section',$old_image);
            return $upload;
        }

        return false;
    }
}
