<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Framework\Url;

class DecoderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \Magento\Framework\Url\Encoder::encode
     * @covers \Magento\Framework\Url\Decoder::decode
     */
    public function testDecode()
    {
        $urlBuilderMock = $this->getMock('Magento\Framework\UrlInterface', [], [], '', false);
        /** @var $urlBuilderMock \Magento\Framework\UrlInterface|\PHPUnit_Framework_MockObject_MockObject */
        $decoder = new Decoder($urlBuilderMock);
        $encoder = new Encoder();

        $data = uniqid();
        $result = $encoder->encode($data);
        $urlBuilderMock->expects($this->once())
            ->method('sessionUrlVar')
            ->with($this->equalTo($data))
            ->will($this->returnValue($result));
        $this->assertNotContains('&', $result);
        $this->assertNotContains('%', $result);
        $this->assertNotContains('+', $result);
        $this->assertNotContains('=', $result);
        $this->assertEquals($result, $decoder->decode($result));
    }
}
