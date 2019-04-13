<?php

namespace Omnipay\Mollie\Message\Request;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Mollie\Message\Response\RevokeSubscriptionResponse;

/**
 * Revoke a customer's subscription.
 *
 * @see https://docs.mollie.com/reference/v2/mandates-api/revoke-mandate
 * @method RevokeSubscriptionResponse send()
 */
class RevokeSubscriptionRequest extends AbstractMollieRequest
{
    /**
     * @return string
     */
    public function getCustomerReference()
    {
        return $this->getParameter('customerReference');
    }

    /**
     * @param string $value
     * @return AbstractRequest
     */
    public function setCustomerReference($value)
    {
        return $this->setParameter('customerReference', $value);
    }

    /**
     * @return string
     */
    public function getSubscriptionId()
    {
        return $this->getParameter('subscriptionId');
    }

    /**
     * @param string $value
     * @return AbstractRequest
     */
    public function setSubscriptionId($value)
    {
        return $this->setParameter('subscriptionId', $value);
    }

    /**
     * @return array
     * @throws InvalidRequestException
     */
    public function getData()
    {
        $this->validate('apiKey', 'customerReference', 'subscriptionId');

        $data['customerReference'] = $this->getCustomerReference();
        $data['subscriptionId'] = $this->getSubscriptionId();

        return $data;
    }
    
    /**
     * @param array $data
     * @return RevokeSubscriptionResponse
     */
    public function sendData($data)
    {
        $response = $this->sendRequest(
            self::DELETE,
            "/customers/{$this->getCustomerReference()}/subscriptions/{$this->getSubscriptionId()}"
        );

        return $this->response = new RevokeSubscriptionResponse($this, $response);
    }
}
