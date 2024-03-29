<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


/**
 *  Klasa do uwierzytelniania i wysyłania danych za pomocą REST API FreshMail
 *
 * @author Tadeusz Kania, Piotr Suszalski
 * @since  2012-06-14
 */
class FmRestApi
{
	private $strApiSecret = null;
	private $strApiKey = null;
	private $response = null;
	private $rawResponse = null;
	private $httpCode = null;
	private $contentType = 'application/json';
	private $boolVerifySSL = true;
	const host = 'https://api.freshmail.com/';
	const prefix = 'rest/';
	//--------------------------------------------------------------------------
	/**
	 * Metoda pobiera kody błędów
	 *
	 * @return array
	 */
	public function getErrors()
	{
		if (isset($this->errors['errors'])) {
			return $this->errors['errors'];
		}

		return false;
	}

	/**
	 * @return array
	 */
	public function getResponse()
	{
		return $this->response;
	}

	/**
	 * @return array
	 */
	public function getRawResponse()
	{
		return $this->rawResponse;
	}

	/**
	 * @return array
	 */
	public function getHttpCode()
	{
		return $this->httpCode;
	}

	/**
	 *
	 * @return bool
	 */
	public function getVerifySSL()
	{
		return $this->boolVerifySSL;
	}

	/**
	 * Metoda ustawia secret do API
	 *
	 * @param type $strSectret
	 * @return rest_api
	 */
	public function setApiSecret($strSectret = '')
	{
		$this->strApiSecret = $strSectret;

		return $this;
	}//setApiSecret


	public function setContentType($contentType = '')
	{
		$this->contentType = $contentType;

		return $this;
	}

	/**
	 * Metoda ustawia klucz do API
	 *
	 * @param string $strKey
	 * @return rest_api
	 */
	public function setApiKey($strKey = '')
	{
		$this->strApiKey = $strKey;

		return $this;
	}//setApiKey

	/**
	 *
	 * @param bool $boolVerifySSL
	 * @return rest_api
	 */
	public function setVerifySSL($boolVerifySSL)
	{
		$this->boolVerifySSL = $boolVerifySSL;

		return $this;
	}


	public function doRequest($strUrl, $arrParams = array(), $boolRawResponse = false)
	{

		if (empty($arrParams)) {
			$strPostData = '';
		} elseif ($this->contentType == 'application/json') {
			$strPostData = json_encode($arrParams);
		} elseif (!empty($arrParams)) {
			$strPostData = http_build_query($arrParams);
		}
		$strSign = sha1($this->strApiKey.'/'.self::prefix.$strUrl.$strPostData.$this->strApiSecret);
		$arrHeaders = array();
		$arrHeaders[] = 'X-Rest-ApiKey: '.$this->strApiKey;
		$arrHeaders[] = 'X-Rest-ApiSign: '.$strSign;
		if ($this->contentType) {
			$arrHeaders[] = 'Content-Type: '.$this->contentType;
		}
		$resCurl = curl_init(self::host.self::prefix.$strUrl);
		curl_setopt($resCurl, CURLOPT_HTTPHEADER, $arrHeaders);
		curl_setopt($resCurl, CURLOPT_HEADER, false);
		curl_setopt($resCurl, CURLOPT_RETURNTRANSFER, true);
		if ($strPostData) {
			curl_setopt($resCurl, CURLOPT_POST, true);
			curl_setopt($resCurl, CURLOPT_POSTFIELDS, $strPostData);
		}//endif
		if(!$this->boolVerifySSL) {
			curl_setopt($resCurl, CURLOPT_SSL_VERIFYPEER, false);
		}
		$this->rawResponse = curl_exec($resCurl);
		$this->httpCode = curl_getinfo($resCurl, CURLINFO_HTTP_CODE);
		if ($boolRawResponse) {
			return $this->rawResponse;
		}//endif
		$this->response = json_decode($this->rawResponse, true);
		if ($this->httpCode != 200) {
			$this->errors = $this->response['errors'];
			if (is_array($this->errors)) {
				foreach ($this->errors as $arrError) {
					throw new RestException($arrError['message'], $arrError['code']);
				}//endforeach
			}//endif
		}//endif
		if (is_array($this->response) == false) {
			if(curl_errno($resCurl) == 60) {
				throw new Exception('There was an error with SSL certificate verification, to fix it please go to FreshMail settings and disable SSL verification. [Curl error message: '.curl_error($resCurl).' ('.curl_errno($resCurl).')]');
			} else {
				throw new Exception('Connection error - curl error message: '.curl_error($resCurl).' ('.curl_errno($resCurl).')');
			}
		}//endif
		return $this->response;
	}//doRequest
}

class RestException extends Exception
{
}
