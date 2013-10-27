#!/usr/bin/env ruby

require 'rubygems'
require 'selenium-webdriver'
require 'mysql'



@browser = Selenium::WebDriver.for :chrome

def pattern_number
  @browser.find_element(:id, 'product_name').text
end

def pattern_collection
  if !@browser.find_elements(:id, 'brand_image').empty?
    @browser.find_element(:id, 'brand_image').find_element(:tag_name, 'img').attribute('title')
  end
end


urls = ['http://voguepatterns.mccall.com/v1350-products-46626.php?page_id=1112', 'http://voguepatterns.mccall.com/v1174-products-11082.php?page_id=1107', 'http://voguepatterns.mccall.com/v8721-products-13668.php?page_id=4447']
urls.each { |url|  

  @browser.get url
#http://voguepatterns.mccall.com/v1350-products-46626.php?page_id=1112
#http://voguepatterns.mccall.com/v1174-products-11082.php?page_id=1107

  patterns = {:pattern_number => pattern_number, :pattern_collection => pattern_collection}

  File.open('/Users/kalsop/Documents/Personal/Dev/webdriver/results', 'a+') do | file |
    patterns.each_value do | value | 
      file.write("#{value},")
    end
    file.write "\n" 
  end
}


at_exit do
  @browser.quit
end
