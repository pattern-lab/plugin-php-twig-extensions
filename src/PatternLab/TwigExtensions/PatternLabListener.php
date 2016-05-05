<?php

/*!
 * Twig Extensions Listener Class
 *
 * Copyright (c) 2016 Dave Olsen, http://dmolsen.com
 * Licensed under the MIT license
 *
 * Adds Twig Extensions support to the Twig Pattern Engine
 *
 */

namespace PatternLab\TwigExtensions;

use \PatternLab\PatternEngine\Twig\TwigUtil;

class PatternLabListener extends \PatternLab\Listener {
  
  /**
  * Add the listeners for this plug-in
  */
  public function __construct() {
    
    $this->addListener("twigPatternLoader.customize","addExtensions");
    
  }
  
  /**
  * Add the extensions to the appropriate instance
  */
  public function addExtensions() {
    
    $instance = TwigUtil::getInstance();
    $instance->addExtension(new \Twig_Extensions_Extension_Text());
    if (function_exists('gettext')) {
      $instance->addExtension(new \Twig_Extensions_Extension_I18n());
    }
    if (class_exists("Collator")) {
      $instance->addExtension(new \Twig_Extensions_Extension_Intl());
    }
    $instance->addExtension(new \Twig_Extensions_Extension_Array());
    $instance->addExtension(new \Twig_Extensions_Extension_Date());
    TwigUtil::setInstance($instance);
    
  }
  
}
