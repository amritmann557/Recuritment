<?php
/**
 * Copyright (c) 2015-present, Facebook, Inc. All rights reserved.
 *
 * You are hereby granted a non-exclusive, worldwide, royalty-free license to
 * use, copy, modify, and distribute this software in source code or binary
 * form for use in connection with the web services and APIs provided by
 * Facebook.
 *
 * As with any software that integrates with the Facebook platform, your use
 * of this software is subject to the Facebook Developer Principles and
 * Policies [http://developers.facebook.com/policy/]. This copyright notice
 * shall be included in all copies or substantial portions of the software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
 * THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
 * DEALINGS IN THE SOFTWARE.
 *
 */

namespace FacebookAds\Object;

use FacebookAds\ApiRequest;
use FacebookAds\Cursor;
use FacebookAds\Http\RequestInterface;
use FacebookAds\TypeChecker;
use FacebookAds\Object\Fields\AdFields;
use FacebookAds\Object\Values\AdBidTypeValues;
use FacebookAds\Object\Values\AdCampaignStatsActionAttributionDaysAfterClickValues;
use FacebookAds\Object\Values\AdCampaignStatsActionAttributionDaysAfterImpValues;
use FacebookAds\Object\Values\AdConfiguredStatusValues;
use FacebookAds\Object\Values\AdDatePresetValues;
use FacebookAds\Object\Values\AdEffectiveStatusValues;
use FacebookAds\Object\Values\AdExecutionOptionsValues;
use FacebookAds\Object\Values\AdOperatorValues;
use FacebookAds\Object\Values\AdPreviewAdFormatValues;
use FacebookAds\Object\Values\AdPreviewRenderTypeValues;
use FacebookAds\Object\Values\AdRestrictionValues;
use FacebookAds\Object\Values\AdStatusOptionValues;
use FacebookAds\Object\Values\AdStatusValues;
use FacebookAds\Object\Values\AdgroupActivityChangedAllValues;
use FacebookAds\Object\Values\AdgroupActivityChangedAnyValues;
use FacebookAds\Object\Values\AdsInsightsActionAttributionWindowsValues;
use FacebookAds\Object\Values\AdsInsightsActionBreakdownsValues;
use FacebookAds\Object\Values\AdsInsightsActionReportTimeValues;
use FacebookAds\Object\Values\AdsInsightsBreakdownsValues;
use FacebookAds\Object\Values\AdsInsightsDatePresetValues;
use FacebookAds\Object\Values\AdsInsightsLevelValues;
use FacebookAds\Object\Values\AdsInsightsSummaryActionBreakdownsValues;
use FacebookAds\Object\Values\AdsReportBuilderAttributionWindowsValues;
use FacebookAds\Object\Values\AdsReportBuilderDatePresetValues;
use FacebookAds\Object\Values\AdsReportBuilderDimensionsValues;
use FacebookAds\Object\Traits\AdLabelAwareCrudObjectTrait;

/**
 * This class is auto-generated.
 *
 * For any issues or feature requests related to this class, please let us know
 * on github and we'll fix in our codegen framework. We'll not be able to accept
 * pull request for this class.
 *
 */

class Ad extends AbstractArchivableCrudObject
  implements CanRedownloadInterface {

  use AdLabelAwareCrudObjectTrait;

  /**
   * @deprecated getEndpoint function is deprecated
   */
  protected function getEndpoint() {
    return 'ads';
  }

  /**
   * @return AdFields
   */
  public static function getFieldsEnum() {
    return AdFields::getInstance();
  }

  protected static function getReferencedEnums() {
    $ref_enums = array();
    $ref_enums['BidType'] = AdBidTypeValues::getInstance()->getValues();
    $ref_enums['ConfiguredStatus'] = AdConfiguredStatusValues::getInstance()->getValues();
    $ref_enums['EffectiveStatus'] = AdEffectiveStatusValues::getInstance()->getValues();
    $ref_enums['Status'] = AdStatusValues::getInstance()->getValues();
    $ref_enums['DatePreset'] = AdDatePresetValues::getInstance()->getValues();
    $ref_enums['ExecutionOptions'] = AdExecutionOptionsValues::getInstance()->getValues();
    $ref_enums['Operator'] = AdOperatorValues::getInstance()->getValues();
    $ref_enums['StatusOption'] = AdStatusOptionValues::getInstance()->getValues();
    $ref_enums['Restriction'] = AdRestrictionValues::getInstance()->getValues();
    return $ref_enums;
  }


  public function getActivityLogs(array $fields = array(), array $params = array(), $pending = false) {
    $this->assureId();

    $param_types = array(
      'changed_all' => 'list<changed_all_enum>',
      'changed_any' => 'list<changed_any_enum>',
      'since' => 'Object',
      'until' => 'Object',
    );
    $enums = array(
      'changed_all_enum' => AdgroupActivityChangedAllValues::getInstance()->getValues(),
      'changed_any_enum' => AdgroupActivityChangedAnyValues::getInstance()->getValues(),
    );

    $request = new ApiRequest(
      $this->api,
      $this->data['id'],
      RequestInterface::METHOD_GET,
      '/activity_logs',
      new AdgroupActivity(),
      'EDGE',
      AdgroupActivity::getFieldsEnum()->getValues(),
      new TypeChecker($param_types, $enums)
    );
    $request->addParams($params);
    $request->addFields($fields);
    return $pending ? $request : $request->execute();
  }

  public function getAdCreatives(array $fields = array(), array $params = array(), $pending = false) {
    $this->assureId();

    $param_types = array(
    );
    $enums = array(
    );

    $request = new ApiRequest(
      $this->api,
      $this->data['id'],
      RequestInterface::METHOD_GET,
      '/adcreatives',
      new AdCreative(),
      'EDGE',
      AdCreative::getFieldsEnum()->getValues(),
      new TypeChecker($param_types, $enums)
    );
    $request->addParams($params);
    $request->addFields($fields);
    return $pending ? $request : $request->execute();
  }

  public function getAdDrafts(array $fields = array(), array $params = array(), $pending = false) {
    $this->assureId();

    $param_types = array(
    );
    $enums = array(
    );

    $request = new ApiRequest(
      $this->api,
      $this->data['id'],
      RequestInterface::METHOD_GET,
      '/addrafts',
      new AdDraft(),
      'EDGE',
      AdDraft::getFieldsEnum()->getValues(),
      new TypeChecker($param_types, $enums)
    );
    $request->addParams($params);
    $request->addFields($fields);
    return $pending ? $request : $request->execute();
  }

  public function deleteAdLabels(array $fields = array(), array $params = array(), $pending = false) {
    $this->assureId();

    $param_types = array(
      'adlabels' => 'list<Object>',
      'execution_options' => 'list<execution_options_enum>',
    );
    $enums = array(
      'execution_options_enum' => array(
        'validate_only',
      ),
    );

    $request = new ApiRequest(
      $this->api,
      $this->data['id'],
      RequestInterface::METHOD_DELETE,
      '/adlabels',
      new AbstractCrudObject(),
      'EDGE',
      array(),
      new TypeChecker($param_types, $enums)
    );
    $request->addParams($params);
    $request->addFields($fields);
    return $pending ? $request : $request->execute();
  }

  public function createAdLabel(array $fields = array(), array $params = array(), $pending = false) {
    $this->assureId();

    $param_types = array(
      'adlabels' => 'list<Object>',
      'execution_options' => 'list<execution_options_enum>',
    );
    $enums = array(
      'execution_options_enum' => array(
        'validate_only',
      ),
    );

    $request = new ApiRequest(
      $this->api,
      $this->data['id'],
      RequestInterface::METHOD_POST,
      '/adlabels',
      new Ad(),
      'EDGE',
      Ad::getFieldsEnum()->getValues(),
      new TypeChecker($param_types, $enums)
    );
    $request->addParams($params);
    $request->addFields($fields);
    return $pending ? $request : $request->execute();
  }

  public function getAdRulesGoverned(array $fields = array(), array $params = array(), $pending = false) {
    $this->assureId();

    $param_types = array(
      'pass_evaluation' => 'bool',
    );
    $enums = array(
    );

    $request = new ApiRequest(
      $this->api,
      $this->data['id'],
      RequestInterface::METHOD_GET,
      '/adrules_governed',
      new AdRule(),
      'EDGE',
      AdRule::getFieldsEnum()->getValues(),
      new TypeChecker($param_types, $enums)
    );
    $request->addParams($params);
    $request->addFields($fields);
    return $pending ? $request : $request->execute();
  }

  public function getColumnSuggestions(array $fields = array(), array $params = array(), $pending = false) {
    $this->assureId();

    $param_types = array(
    );
    $enums = array(
    );

    $request = new ApiRequest(
      $this->api,
      $this->data['id'],
      RequestInterface::METHOD_GET,
      '/column_suggestions',
      new ColumnSuggestions(),
      'EDGE',
      ColumnSuggestions::getFieldsEnum()->getValues(),
      new TypeChecker($param_types, $enums)
    );
    $request->addParams($params);
    $request->addFields($fields);
    return $pending ? $request : $request->execute();
  }

  public function getConversions(array $fields = array(), array $params = array(), $pending = false) {
    $this->assureId();

    $param_types = array(
      'start_time' => 'datetime',
      'end_time' => 'datetime',
      'time_start' => 'datetime',
      'time_stop' => 'datetime',
      'aggregate_days' => 'int',
      'by_impression_time' => 'bool',
      'include_deleted' => 'bool',
      'offset' => 'int',
    );
    $enums = array(
    );

    $request = new ApiRequest(
      $this->api,
      $this->data['id'],
      RequestInterface::METHOD_GET,
      '/conversions',
      new AdConversions(),
      'EDGE',
      AdConversions::getFieldsEnum()->getValues(),
      new TypeChecker($param_types, $enums)
    );
    $request->addParams($params);
    $request->addFields($fields);
    return $pending ? $request : $request->execute();
  }

  public function getCopies(array $fields = array(), array $params = array(), $pending = false) {
    $this->assureId();

    $param_types = array(
      'include_deleted' => 'bool',
      'effective_status' => 'list<string>',
      'date_preset' => 'date_preset_enum',
      'time_range' => 'Object',
      'updated_since' => 'int',
    );
    $enums = array(
      'date_preset_enum' => AdDatePresetValues::getInstance()->getValues(),
    );

    $request = new ApiRequest(
      $this->api,
      $this->data['id'],
      RequestInterface::METHOD_GET,
      '/copies',
      new Ad(),
      'EDGE',
      Ad::getFieldsEnum()->getValues(),
      new TypeChecker($param_types, $enums)
    );
    $request->addParams($params);
    $request->addFields($fields);
    return $pending ? $request : $request->execute();
  }

  public function createCopy(array $fields = array(), array $params = array(), $pending = false) {
    $this->assureId();

    $param_types = array(
      'adset_id' => 'string',
      'rename_options' => 'Object',
      'status_option' => 'status_option_enum',
    );
    $enums = array(
      'status_option_enum' => AdStatusOptionValues::getInstance()->getValues(),
    );

    $request = new ApiRequest(
      $this->api,
      $this->data['id'],
      RequestInterface::METHOD_POST,
      '/copies',
      new Ad(),
      'EDGE',
      Ad::getFieldsEnum()->getValues(),
      new TypeChecker($param_types, $enums)
    );
    $request->addParams($params);
    $request->addFields($fields);
    return $pending ? $request : $request->execute();
  }

  public function getInsights(array $fields = array(), array $params = array(), $pending = false) {
    $this->assureId();

    $param_types = array(
      'default_summary' => 'bool',
      'fields' => 'list<string>',
      'filtering' => 'list<Object>',
      'summary' => 'list<string>',
      'sort' => 'list<string>',
      'action_attribution_windows' => 'list<action_attribution_windows_enum>',
      'action_breakdowns' => 'list<action_breakdowns_enum>',
      'action_report_time' => 'action_report_time_enum',
      'breakdowns' => 'list<breakdowns_enum>',
      'date_preset' => 'date_preset_enum',
      'export_columns' => 'list<string>',
      'export_format' => 'string',
      'export_name' => 'string',
      'level' => 'level_enum',
      'product_id_limit' => 'int',
      'summary_action_breakdowns' => 'list<summary_action_breakdowns_enum>',
      'time_increment' => 'string',
      'time_range' => 'Object',
      'time_ranges' => 'list<Object>',
      'use_account_attribution_setting' => 'bool',
    );
    $enums = array(
      'action_attribution_windows_enum' => AdsInsightsActionAttributionWindowsValues::getInstance()->getValues(),
      'action_breakdowns_enum' => AdsInsightsActionBreakdownsValues::getInstance()->getValues(),
      'action_report_time_enum' => AdsInsightsActionReportTimeValues::getInstance()->getValues(),
      'breakdowns_enum' => AdsInsightsBreakdownsValues::getInstance()->getValues(),
      'date_preset_enum' => AdsInsightsDatePresetValues::getInstance()->getValues(),
      'level_enum' => AdsInsightsLevelValues::getInstance()->getValues(),
      'summary_action_breakdowns_enum' => AdsInsightsSummaryActionBreakdownsValues::getInstance()->getValues(),
    );

    $request = new ApiRequest(
      $this->api,
      $this->data['id'],
      RequestInterface::METHOD_GET,
      '/insights',
      new AdsInsights(),
      'EDGE',
      AdsInsights::getFieldsEnum()->getValues(),
      new TypeChecker($param_types, $enums)
    );
    $request->addParams($params);
    $request->addFields($fields);
    return $pending ? $request : $request->execute();
  }

  public function getInsightsAsync(array $fields = array(), array $params = array(), $pending = false) {
    $this->assureId();

    $param_types = array(
      'default_summary' => 'bool',
      'fields' => 'list<string>',
      'filtering' => 'list<Object>',
      'summary' => 'list<string>',
      'sort' => 'list<string>',
      'action_attribution_windows' => 'list<action_attribution_windows_enum>',
      'action_breakdowns' => 'list<action_breakdowns_enum>',
      'action_report_time' => 'action_report_time_enum',
      'breakdowns' => 'list<breakdowns_enum>',
      'date_preset' => 'date_preset_enum',
      'export_columns' => 'list<string>',
      'export_format' => 'string',
      'export_name' => 'string',
      'level' => 'level_enum',
      'product_id_limit' => 'int',
      'summary_action_breakdowns' => 'list<summary_action_breakdowns_enum>',
      'time_increment' => 'string',
      'time_range' => 'Object',
      'time_ranges' => 'list<Object>',
      'use_account_attribution_setting' => 'bool',
    );
    $enums = array(
      'action_attribution_windows_enum' => AdsInsightsActionAttributionWindowsValues::getInstance()->getValues(),
      'action_breakdowns_enum' => AdsInsightsActionBreakdownsValues::getInstance()->getValues(),
      'action_report_time_enum' => AdsInsightsActionReportTimeValues::getInstance()->getValues(),
      'breakdowns_enum' => AdsInsightsBreakdownsValues::getInstance()->getValues(),
      'date_preset_enum' => AdsInsightsDatePresetValues::getInstance()->getValues(),
      'level_enum' => AdsInsightsLevelValues::getInstance()->getValues(),
      'summary_action_breakdowns_enum' => AdsInsightsSummaryActionBreakdownsValues::getInstance()->getValues(),
    );

    $request = new ApiRequest(
      $this->api,
      $this->data['id'],
      RequestInterface::METHOD_POST,
      '/insights',
      new AdReportRun(),
      'EDGE',
      AdReportRun::getFieldsEnum()->getValues(),
      new TypeChecker($param_types, $enums)
    );
    $request->addParams($params);
    $request->addFields($fields);
    return $pending ? $request : $request->execute();
  }

  public function getKeywordStats(array $fields = array(), array $params = array(), $pending = false) {
    $this->assureId();

    $param_types = array(
      'date' => 'datetime',
    );
    $enums = array(
    );

    $request = new ApiRequest(
      $this->api,
      $this->data['id'],
      RequestInterface::METHOD_GET,
      '/keywordstats',
      new AdKeywordStats(),
      'EDGE',
      AdKeywordStats::getFieldsEnum()->getValues(),
      new TypeChecker($param_types, $enums)
    );
    $request->addParams($params);
    $request->addFields($fields);
    return $pending ? $request : $request->execute();
  }

  public function getLeads(array $fields = array(), array $params = array(), $pending = false) {
    $this->assureId();

    $param_types = array(
    );
    $enums = array(
    );

    $request = new ApiRequest(
      $this->api,
      $this->data['id'],
      RequestInterface::METHOD_GET,
      '/leads',
      new Lead(),
      'EDGE',
      Lead::getFieldsEnum()->getValues(),
      new TypeChecker($param_types, $enums)
    );
    $request->addParams($params);
    $request->addFields($fields);
    return $pending ? $request : $request->execute();
  }

  public function createLead(array $fields = array(), array $params = array(), $pending = false) {
    $this->assureId();

    $param_types = array(
      'start_time' => 'datetime',
      'end_time' => 'datetime',
      'session_id' => 'string',
    );
    $enums = array(
    );

    $request = new ApiRequest(
      $this->api,
      $this->data['id'],
      RequestInterface::METHOD_POST,
      '/leads',
      new Lead(),
      'EDGE',
      Lead::getFieldsEnum()->getValues(),
      new TypeChecker($param_types, $enums)
    );
    $request->addParams($params);
    $request->addFields($fields);
    return $pending ? $request : $request->execute();
  }

  public function getPreviews(array $fields = array(), array $params = array(), $pending = false) {
    $this->assureId();

    $param_types = array(
      'ad_format' => 'ad_format_enum',
      'dynamic_creative_spec' => 'Object',
      'interactive' => 'bool',
      'post' => 'Object',
      'height' => 'unsigned int',
      'width' => 'unsigned int',
      'place_page_id' => 'int',
      'product_item_ids' => 'list<string>',
      'start_date' => 'datetime',
      'end_date' => 'datetime',
      'locale' => 'string',
      'render_type' => 'render_type_enum',
    );
    $enums = array(
      'ad_format_enum' => AdPreviewAdFormatValues::getInstance()->getValues(),
      'render_type_enum' => AdPreviewRenderTypeValues::getInstance()->getValues(),
    );

    $request = new ApiRequest(
      $this->api,
      $this->data['id'],
      RequestInterface::METHOD_GET,
      '/previews',
      new AdPreview(),
      'EDGE',
      AdPreview::getFieldsEnum()->getValues(),
      new TypeChecker($param_types, $enums)
    );
    $request->addParams($params);
    $request->addFields($fields);
    return $pending ? $request : $request->execute();
  }

  public function getReporting(array $fields = array(), array $params = array(), $pending = false) {
    $this->assureId();

    $param_types = array(
      'attribution_windows' => 'list<attribution_windows_enum>',
      'dimensions' => 'list<dimensions_enum>',
      'dimension_groups' => 'list<list<adgroupreporting_dimension_groups_enum_param>>',
      'locked_dimensions' => 'unsigned int',
      'metrics' => 'list<string>',
      'filtering' => 'Object',
      'sorting' => 'list<map>',
      'date_preset' => 'date_preset_enum',
      'time_range' => 'Object',
      'default_summary' => 'bool',
      'last_report_snapshot_id' => 'unsigned int',
      'offset' => 'unsigned int',
      'limit' => 'int',
      'pagination_key' => 'string',
      'last_dimension' => 'Object',
      'summary_count' => 'bool',
    );
    $enums = array(
      'attribution_windows_enum' => AdsReportBuilderAttributionWindowsValues::getInstance()->getValues(),
      'dimensions_enum' => AdsReportBuilderDimensionsValues::getInstance()->getValues(),
      'date_preset_enum' => AdsReportBuilderDatePresetValues::getInstance()->getValues(),
    );

    $request = new ApiRequest(
      $this->api,
      $this->data['id'],
      RequestInterface::METHOD_GET,
      '/reporting',
      new AdsReportBuilder(),
      'EDGE',
      AdsReportBuilder::getFieldsEnum()->getValues(),
      new TypeChecker($param_types, $enums)
    );
    $request->addParams($params);
    $request->addFields($fields);
    return $pending ? $request : $request->execute();
  }

  public function getStats(array $fields = array(), array $params = array(), $pending = false) {
    $this->assureId();

    $param_types = array(
      'start_time' => 'datetime',
      'end_time' => 'datetime',
      'time_start' => 'datetime',
      'time_stop' => 'datetime',
      'action_attribution_days_after_click' => 'action_attribution_days_after_click_enum',
      'action_attribution_days_after_imp' => 'action_attribution_days_after_imp_enum',
    );
    $enums = array(
      'action_attribution_days_after_click_enum' => AdCampaignStatsActionAttributionDaysAfterClickValues::getInstance()->getValues(),
      'action_attribution_days_after_imp_enum' => AdCampaignStatsActionAttributionDaysAfterImpValues::getInstance()->getValues(),
    );

    $request = new ApiRequest(
      $this->api,
      $this->data['id'],
      RequestInterface::METHOD_GET,
      '/stats',
      new AdCampaignStats(),
      'EDGE',
      AdCampaignStats::getFieldsEnum()->getValues(),
      new TypeChecker($param_types, $enums)
    );
    $request->addParams($params);
    $request->addFields($fields);
    return $pending ? $request : $request->execute();
  }

  public function getTargetingSentenceLines(array $fields = array(), array $params = array(), $pending = false) {
    $this->assureId();

    $param_types = array(
    );
    $enums = array(
    );

    $request = new ApiRequest(
      $this->api,
      $this->data['id'],
      RequestInterface::METHOD_GET,
      '/targetingsentencelines',
      new TargetingSentenceLine(),
      'EDGE',
      TargetingSentenceLine::getFieldsEnum()->getValues(),
      new TypeChecker($param_types, $enums)
    );
    $request->addParams($params);
    $request->addFields($fields);
    return $pending ? $request : $request->execute();
  }

  public function deleteTrackingTag(array $fields = array(), array $params = array(), $pending = false) {
    $this->assureId();

    $param_types = array(
    );
    $enums = array(
    );

    $request = new ApiRequest(
      $this->api,
      $this->data['id'],
      RequestInterface::METHOD_DELETE,
      '/trackingtag',
      new AbstractCrudObject(),
      'EDGE',
      array(),
      new TypeChecker($param_types, $enums)
    );
    $request->addParams($params);
    $request->addFields($fields);
    return $pending ? $request : $request->execute();
  }

  public function createTrackingTag(array $fields = array(), array $params = array(), $pending = false) {
    $this->assureId();

    $param_types = array(
      'url' => 'string',
      'add_template_param' => 'bool',
    );
    $enums = array(
    );

    $request = new ApiRequest(
      $this->api,
      $this->data['id'],
      RequestInterface::METHOD_POST,
      '/trackingtag',
      new AbstractCrudObject(),
      'EDGE',
      array(),
      new TypeChecker($param_types, $enums)
    );
    $request->addParams($params);
    $request->addFields($fields);
    return $pending ? $request : $request->execute();
  }

  public function deleteSelf(array $fields = array(), array $params = array(), $pending = false) {
    $this->assureId();

    $param_types = array(
    );
    $enums = array(
    );

    $request = new ApiRequest(
      $this->api,
      $this->data['id'],
      RequestInterface::METHOD_DELETE,
      '/',
      new AbstractCrudObject(),
      'NODE',
      array(),
      new TypeChecker($param_types, $enums)
    );
    $request->addParams($params);
    $request->addFields($fields);
    return $pending ? $request : $request->execute();
  }

  public function getSelf(array $fields = array(), array $params = array(), $pending = false) {
    $this->assureId();

    $param_types = array(
      'date_preset' => 'date_preset_enum',
      'from_adtable' => 'bool',
      'review_feedback_breakdown' => 'bool',
      'time_range' => 'Object',
    );
    $enums = array(
      'date_preset_enum' => array(
        'today',
        'yesterday',
        'this_month',
        'last_month',
        'this_quarter',
        'lifetime',
        'last_3d',
        'last_7d',
        'last_14d',
        'last_28d',
        'last_30d',
        'last_90d',
        'last_week_mon_sun',
        'last_week_sun_sat',
        'last_quarter',
        'last_year',
        'this_week_mon_today',
        'this_week_sun_today',
        'this_year',
      ),
    );

    $request = new ApiRequest(
      $this->api,
      $this->data['id'],
      RequestInterface::METHOD_GET,
      '/',
      new Ad(),
      'NODE',
      Ad::getFieldsEnum()->getValues(),
      new TypeChecker($param_types, $enums)
    );
    $request->addParams($params);
    $request->addFields($fields);
    return $pending ? $request : $request->execute();
  }

  public function updateSelf(array $fields = array(), array $params = array(), $pending = false) {
    $this->assureId();

    $param_types = array(
      'audience_id' => 'string',
      'include_demolink_hashes' => 'bool',
      'creative' => 'AdCreative',
      'name' => 'string',
      'status' => 'status_enum',
      'priority' => 'unsigned int',
      'tracking_specs' => 'Object',
      'display_sequence' => 'unsigned int',
      'engagement_audience' => 'bool',
      'social_required' => 'bool',
      'adset_spec' => 'AdSet',
      'draft_adgroup_id' => 'string',
      'execution_options' => 'list<execution_options_enum>',
      'adlabels' => 'list<Object>',
      'bid_amount' => 'int',
      'redownload' => 'bool',
    );
    $enums = array(
      'status_enum' => AdStatusValues::getInstance()->getValues(),
      'execution_options_enum' => AdExecutionOptionsValues::getInstance()->getValues(),
    );

    $request = new ApiRequest(
      $this->api,
      $this->data['id'],
      RequestInterface::METHOD_POST,
      '/',
      new Ad(),
      'NODE',
      Ad::getFieldsEnum()->getValues(),
      new TypeChecker($param_types, $enums)
    );
    $request->addParams($params);
    $request->addFields($fields);
    return $pending ? $request : $request->execute();
  }

}
