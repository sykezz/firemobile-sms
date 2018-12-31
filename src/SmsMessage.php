<?php
namespace Sykez\FireMobileSms;

class SmsMessage
{
    /**
     * The message content.
     *
     * @var string
     */
    public $content;
    /**
     * Create a new message instance.
     *
     * @param   string $message
     * @return  void
     */
    public function __construct($content = '')
    {
        $this->content = $content;
    }
    /**
     * Set the message content.
     *
     * @param  string $content
     * @return $this
     */
    public function content($content)
    {
        $this->content = $content;
        return $this;
    }
}