<?php

namespace Omnipay\Mollie\Message\Request;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\ResponseInterface;
use Omnipay\Mollie\Message\Response\CreateSubscriptionResponse;

/**
 * Create a payment with the Mollie API.
 *
 * @see https://docs.mollie.com/reference/v2/payments-api/create-payment
 * @method CreateSubscriptionResponse send()
 */
class CreateSubscriptionRequest extends AbstractMollieRequest
{
    /**
     * @return array
     */
    public function getMetadata()
    {
        return $this->getParameter('metadata');
    }

    /**
     * @param array $value
     * @return $this
     */
    public function setMetadata(array $value)
    {
        return $this->setParameter('metadata', $value);
    }


    /**
     * @return string
     */
    public function getCustomerReference()
    {
        return $this->getParameter('customerReference');
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setCustomerReference($value)
    {
        return $this->setParameter('customerReference', $value);
    }

    public function getInterval()
    {
        return $this->getParameter('interval');
    }

    public function setInterval($value)
    {
        return $this->setParameter('interval', $value);
    }		
	
    /**
     * @return array
     * @throws InvalidRequestException
     */
    public function getData()
    {
        $this->validate('apiKey', 'amount', 'currency', 'description');

        $data = [];
        $data['amount'] = [
            "value" => $this->getAmount(),
            "currency" => $this->getCurrency()
        ];
        $data['interval'] = $this->getInterval();
        $data['description'] = $this->getDescription();
        $data['metadata'] = $this->getMetadata();

        if ($this->getTransactionId()) {
            $data['metadata']['transactionId'] = $this->getTransactionId();
        }

        $webhookUrl = $this->getNotifyUrl();
        if (null !== $webhookUrl) {
            $data['webhookUrl'] = $webhookUrl;
        }

        return $data;
    }

    /**
     * @param array $data
     * @return ResponseInterface|PurchaseResponse
     */
    public function sendData($data)
    {
        $response = $this->sendRequest(self::POST, "/customers/{$this->getCustomerReference()}/subscriptions", $data);

        return $this->response = new CreateSubscriptionResponse($this, $response);
    }
}
