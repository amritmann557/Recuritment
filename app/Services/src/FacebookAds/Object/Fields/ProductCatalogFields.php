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

namespace FacebookAds\Object\Fields;

use FacebookAds\Enum\AbstractEnum;

/**
 * This class is auto-generated.
 *
 * For any issues or feature requests related to this class, please let us know
 * on github and we'll fix in our codegen framework. We'll not be able to accept
 * pull request for this class.
 *
 */

class ProductCatalogFields extends AbstractEnum {

  const BUSINESS = 'business';
  const DA_DISPLAY_SETTINGS = 'da_display_settings';
  const DEFAULT_IMAGE_URL = 'default_image_url';
  const FALLBACK_IMAGE_URL = 'fallback_image_url';
  const FEED_COUNT = 'feed_count';
  const FLIGHT_CATALOG_SETTINGS = 'flight_catalog_settings';
  const ID = 'id';
  const IMAGE_PADDING_LANDSCAPE = 'image_padding_landscape';
  const IMAGE_PADDING_SQUARE = 'image_padding_square';
  const NAME = 'name';
  const PRODUCT_COUNT = 'product_count';
  const QUALIFIED_PRODUCT_COUNT = 'qualified_product_count';
  const VERTICAL = 'vertical';
  const DESTINATION_CATALOG_SETTINGS = 'destination_catalog_settings';

  public function getFieldTypes() {
      
    return array(
      'business' => 'Business',
      'da_display_settings' => 'ProductCatalogImageSettings',
      'default_image_url' => 'string',
      'fallback_image_url' => 'list<string>',
      'feed_count' => 'int',
      'flight_catalog_settings' => 'FlightCatalogSettings',
      'id' => 'string',
      'image_padding_landscape' => 'bool',
      'image_padding_square' => 'bool',
      'name' => 'string',
      'product_count' => 'int',
      'qualified_product_count' => 'unsigned int',
      'vertical' => 'string',
      'destination_catalog_settings' => 'map',
    );
  }
}
