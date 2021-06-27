<?php

class LocalBusinessSettings extends GenericSettings
{
    protected $settingsGroup = 'mySEOPluginLocalBusinessPage';
    protected $name = 'local_business';
    protected $defaultSection = 'my_seo_settings_pluginPage_section';
    protected $adminTitle = 'Local Business Schema';

    protected function _printAdminPageDescription()
    {
        echo '<p>A particular physical business or branch of an organization. Examples of LocalBusiness include a restaurant,
        a particular branch of a restaurant chain, a branch of a bank, a medical practice, a club, a bowling alley, etc...</p>';
    }


    public function initSettingsPage()
    {
        $this->_addSection('servicearea', __('Service Area', 'my_seo_settings'));
        $this->_addSection('openinghours', __('Opening Hours', 'my_seo_settings'), 'A point in time recurring on multiple days in the form hh:mm:ss[Z|(+|-)hh:mm]');
        $this->_addSection('brand_contactpoint', __('Brand and Contact Point', 'my_seo_settings'));
        $this->_addSection('location', __('Business Location', 'my_seo_settings'));
        $this->_addSection('address', __('Business Address', 'my_seo_settings'));

        $this->_addCheckboxField('generate_json_ld_localbusiness', __('Local Business Schema', 'my_seo_settings'));
        $this->_addLocalBusinessType('generate_json_ld_lbtype', __( 'LocalBusiness Type', 'my_seo_settings' ));
		$this->_addlbloo('generate_json_ld_lbloo', __( 'LocalBusiness Location or Organization', 'my_seo_settings' ));
        $this->_addPagesDropdown('generate_json_ld_localbusiness_related_page', __('Display schema on page', 'my_seo_settings'));
        $hint = 'The price range of the business, for example $$$.';
        $this->_addInputField('generate_json_ld_localbusiness_price_range', __('Price Range', 'my_seo_settings'), '', $hint);
        $this->_addInputField('generate_json_ld_localbusiness_telephone', __('Telephone', 'my_seo_settings'));
        $this->_addInputField('generate_json_ld_localbusiness_name', __('Name', 'my_seo_settings'));
        $this->_addInputField('generate_json_ld_localbusiness_url', __('URL', 'my_seo_settings'));
        $this->_addInputField('generate_json_ld_localbusiness_image_url', __('Image URL', 'my_seo_settings'));
        $this->_addInputField('generate_json_ld_localbusiness_logo', __('Logo', 'my_seo_settings'));
        $this->_addInputField('generate_json_ld_localbusiness_description', __('Description', 'my_seo_settings'));

        // Business address
        $this->_addInputField('generate_json_ld_localbusiness_address_street_address', __('Street Address', 'my_seo_settings'), 'address');
        $this->_addInputField('generate_json_ld_localbusiness_address_address_locality', __('Locality', 'my_seo_settings'), 'address');
        $this->_addInputField('generate_json_ld_localbusiness_address_address_region', __('Region', 'my_seo_settings'), 'address');
        $this->_addInputField('generate_json_ld_localbusiness_address_postal_code', __('Postal Code', 'my_seo_settings'), 'address');
        $this->_addInputField('generate_json_ld_localbusiness_address_address_country', __('Country', 'my_seo_settings'), 'address');

        // Service Area
        $this->_addInputField('generate_json_ld_localbusiness_location_area_served', __('Area Served', 'my_seo_settings'), 'servicearea');
        $this->_addInputField('generate_json_ld_localbusiness_geo_latitude', __('GEO Latitude', 'my_seo_settings'), 'servicearea');
        $this->_addInputField('generate_json_ld_localbusiness_geo_longitude', __('GEO Longitude', 'my_seo_settings'), 'servicearea');
        $this->_addTextareaField('generate_json_ld_localbusiness_has_map', __('Has Map', 'my_seo_settings'), 'servicearea');


         // open hours
        $this->_addOpeningHoursMonday('generate_json_ld_localbusiness_days_of_week_day1', __('Opening Hours - Monday', 'my_seo_settings'), 'Monday', 'openinghours');
        $this->_addOpeningHoursTuesday('generate_json_ld_localbusiness_days_of_week_day2', __('Opening Hours - Tuesday', 'my_seo_settings'), 'Tuesday', 'openinghours');
        $this->_addOpeningHoursWednesday('generate_json_ld_localbusiness_days_of_week_day3', __('Opening Hours - Wednesday', 'my_seo_settings'), 'Wednesday', 'openinghours');
        $this->_addOpeningHoursThursday('generate_json_ld_localbusiness_days_of_week_day4', __('Opening Hours - Thursday', 'my_seo_settings'), 'Thursday', 'openinghours');
        $this->_addOpeningHoursFriday('generate_json_ld_localbusiness_days_of_week_day5', __('Opening Hours - Friday', 'my_seo_settings'), 'Friday', 'openinghours');
        $this->_addOpeningHoursSaturday('generate_json_ld_localbusiness_days_of_week_day6', __('Opening Hours - Saturday', 'my_seo_settings'), 'Saturday', 'openinghours');
        $this->_addOpeningHoursSunday('generate_json_ld_localbusiness_days_of_week_day7', __('Opening Hours - Sunday', 'my_seo_settings'), 'Sunday', 'openinghours');

        // Contact point
        $this->_addInputField('generate_json_ld_localbusiness_contact_point_telephone', __('Contact Point Telephone', 'my_seo_settings'), 'brand_contactpoint');
        $this->_addInputField('generate_json_ld_localbusiness_contact_point_email', __('Contact Point Email', 'my_seo_settings'), 'brand_contactpoint');
        $this->_addInputField('generate_json_ld_localbusiness_brand_name', __('Brand Name', 'my_seo_settings'), 'brand_contactpoint');
        $this->_addInputField('generate_json_ld_localbusiness_brand_logo_url', __('Brand Logo URL', 'my_seo_settings'), 'brand_contactpoint');
		$this->_addBrandType('generate_json_ld_brand_lbftype', __( 'Brand Type', 'my_seo_settings' ), 'brand_contactpoint');
        $this->_addInputField('generate_json_ld_localbusiness_location_street_address', __('Location Street Address', 'my_seo_settings'), 'location');
        $this->_addInputField('generate_json_ld_localbusiness_location_address_locality', __('Location Address Locality', 'my_seo_settings'), 'location');
        $this->_addInputField('generate_json_ld_localbusiness_location_address_region', __('Location Address Region', 'my_seo_settings'), 'location');
        $this->_addInputField('generate_json_ld_localbusiness_location_postal_code', __('Location Address Postal Code', 'my_seo_settings'), 'location');
        $this->_addInputField('generate_json_ld_localbusiness_location_address_country', __('Location Address Country', 'my_seo_settings'), 'location');
    }

    private function _addLocalBusinessType($field, $title, $section = '')
    {
        $types = [
            "LocalBusiness" => "LocalBusiness",
            "AnimalShelter" => "AnimalShelter",
            "ArchiveOrganization" => "ArchiveOrganization",
            "AutomotiveBusiness" => "AutomotiveBusiness",
            "ChildCare" => "ChildCare",
            "Dentist" => "Dentist",
            "DryCleaningOrLaundry" => "DryCleaningOrLaundry",
            "EmergencyService" => "EmergencyService",
            "EmploymentAgency" => "EmploymentAgency",
            "EntertainmentBusiness" => "EntertainmentBusiness",
            "FinancialService" => "FinancialService",
            "FoodEstablishment" => "FoodEstablishment",
            "GovernmentOffice" => "GovernmentOffice",
            "HealthAndBeautyBusiness" => "HealthAndBeautyBusiness",
            "HomeAndConstructionBusiness" => "HomeAndConstructionBusiness",
            "InternetCafe" => "InternetCafe",
            "LegalService" => "LegalService",
            "Library" => "Library",
            "LodgingBusiness" => "LodgingBusiness",
            "MedicalBusiness" => "MedicalBusiness",
            "ProfessionalService" => "ProfessionalService",
            "RadioStation" => "RadioStation",
            "RealEstateAgent" => "RealEstateAgent",
            "RecyclingCenter" => "RecyclingCenter",
            "SelfStorage" => "SelfStorage",
            "ShoppingCenter" => "ShoppingCenter",
            "SportsActivityLocation" => "SportsActivityLocation",
            "Store" => "Store",
            "TelevisionStation" => "TelevisionStation",
            "TouristInformationCenter" => "TouristInformationCenter",
            "TravelAgency" => "TravelAgency",
        ];

        $this->_addDropdownField($field, $title, $types, $section);
    }
	
	private function _addBrandType($field, $title, $section = '')
    {
        $types = [
            "Organization" => "Organization",
			"Brand" => "Brand"
        ];

        $this->_addDropdownField($field, $title, $types, $section);
    }
	
	private function _addlbloo($field, $title, $section = '')
    {
        $types = [
            "Organization" => "Organization",
			"Place" => "Place"
        ];

        $this->_addDropdownField($field, $title, $types, $section);
    }
	 private function _addOpeningHoursMonday($field, $title, $day1, $section = '')
    {
        $this->_addCustomField(
            $field,
            $title,
            function ($field, $formField, $formValue) use ($day1) {
                $options = $this->getOptions();
                $formField = $this->getOptionName() . '[opening_hours]';
                $formValue = $options['opening_hours'] ?? '';

                $opens1 = $formValue[$day1]['opens'] ?? '';
                $closes1 = $formValue[$day1]['closes'] ?? '';
                // Special case, override name of the field

                echo "<input type='text' style='width: 10%;' placeholder='opens ex. 09:00' name='${formField}[$day1][opens]' value='$opens1'>";
                echo "<input type='text' style='width: 10%;' placeholder='closes ex. 20:00' name='${formField}[$day1][closes]' value='$closes1'>";
            },
            $section
        );
    }
	 private function _addOpeningHoursTuesday($field, $title, $day2, $section = '')
    {
        $this->_addCustomField(
            $field,
            $title,
            function ($field, $formField, $formValue) use ($day2) {
                $options = $this->getOptions();
                $formField = $this->getOptionName() . '[opening_hours]';
                $formValue = $options['opening_hours'] ?? '';

                $opens2 = $formValue[$day2]['opens'] ?? '';
                $closes2 = $formValue[$day2]['closes'] ?? '';
                // Special case, override name of the field

                echo "<input type='text' style='width: 10%;' placeholder='opens ex. 09:00' name='${formField}[$day2][opens]' value='$opens2'>";
                echo "<input type='text' style='width: 10%;' placeholder='closes ex. 20:00' name='${formField}[$day2][closes]' value='$closes2'>";
            },
            $section
        );
    }
	private function _addOpeningHoursWednesday($field, $title, $day3, $section = '')
    {
        $this->_addCustomField(
            $field,
            $title,
            function ($field, $formField, $formValue) use ($day3) {
                $options = $this->getOptions();
                $formField = $this->getOptionName() . '[opening_hours]';
                $formValue = $options['opening_hours'] ?? '';

                $opens3 = $formValue[$day3]['opens'] ?? '';
                $closes3 = $formValue[$day3]['closes'] ?? '';
                // Special case, override name of the field

                echo "<input type='text' style='width: 10%;' placeholder='opens ex. 09:00' name='${formField}[$day3][opens]' value='$opens3'>";
                echo "<input type='text' style='width: 10%;' placeholder='closes ex. 20:00' name='${formField}[$day3][closes]' value='$closes3'>";
            },
            $section
        );
    }
	private function _addOpeningHoursThursday($field, $title, $day4, $section = '')
    {
        $this->_addCustomField(
            $field,
            $title,
            function ($field, $formField, $formValue) use ($day4) {
                $options = $this->getOptions();
                $formField = $this->getOptionName() . '[opening_hours]';
                $formValue = $options['opening_hours'] ?? '';

                $opens4 = $formValue[$day4]['opens'] ?? '';
                $closes4 = $formValue[$day4]['closes'] ?? '';
                // Special case, override name of the field

                echo "<input type='text' style='width: 10%;' placeholder='opens ex. 09:00' name='${formField}[$day4][opens]' value='$opens4'>";
                echo "<input type='text' style='width: 10%;' placeholder='closes ex. 20:00' name='${formField}[$day4][closes]' value='$closes4'>";
            },
            $section
        );
    }
	private function _addOpeningHoursFriday($field, $title, $day5, $section = '')
    {
        $this->_addCustomField(
            $field,
            $title,
            function ($field, $formField, $formValue) use ($day5) {
                $options = $this->getOptions();
                $formField = $this->getOptionName() . '[opening_hours]';
                $formValue = $options['opening_hours'] ?? '';

                $opens5 = $formValue[$day5]['opens'] ?? '';
                $closes5 = $formValue[$day5]['closes'] ?? '';
                // Special case, override name of the field

                echo "<input type='text' style='width: 10%;' placeholder='opens ex. 09:00' name='${formField}[$day5][opens]' value='$opens5'>";
                echo "<input type='text' style='width: 10%;' placeholder='closes ex. 20:00' name='${formField}[$day5][closes]' value='$closes5'>";
            },
            $section
        );
    }
	private function _addOpeningHoursSaturday($field, $title, $day6, $section = '')
    {
        $this->_addCustomField(
            $field,
            $title,
            function ($field, $formField, $formValue) use ($day6) {
                $options = $this->getOptions();
                $formField = $this->getOptionName() . '[opening_hours]';
                $formValue = $options['opening_hours'] ?? '';

                $opens6 = $formValue[$day6]['opens'] ?? '';
                $closes6 = $formValue[$day6]['closes'] ?? '';
                // Special case, override name of the field

                echo "<input type='text' style='width: 10%;' placeholder='opens ex. 09:00' name='${formField}[$day6][opens]' value='$opens6'>";
                echo "<input type='text' style='width: 10%;' placeholder='closes ex. 20:00' name='${formField}[$day6][closes]' value='$closes6'>";
            },
            $section
        );
    }
	private function _addOpeningHoursSunday($field, $title, $day7, $section = '')
    {
        $this->_addCustomField(
            $field,
            $title,
            function ($field, $formField, $formValue) use ($day7) {
                $options = $this->getOptions();
                $formField = $this->getOptionName() . '[opening_hours]';
                $formValue = $options['opening_hours'] ?? '';

                $opens7 = $formValue[$day7]['opens'] ?? '';
                $closes7 = $formValue[$day7]['closes'] ?? '';
                // Special case, override name of the field

                echo "<input type='text' style='width: 10%;' placeholder='opens ex. 09:00' name='${formField}[$day7][opens]' value='$opens7'>";
                echo "<input type='text' style='width: 10%;' placeholder='closes ex. 20:00' name='${formField}[$day7][closes]' value='$closes7'>";
            },
            $section
        );
    }
}