import React, { useCallback, useState } from "react";
import {
  Layout,
  Button,
  TextField,
  Form,
  FormLayout,
  Card
} from "@shopify/polaris";



export default function FormOnSubmitExample() {

  const [date, setDate] = useState("");
  const [time, setTime] = useState("");

  const handleSubmitDate = useCallback((_event) => {
    setDate("");
    setTime("");
  }, []);
  const handleSubmitTime = useCallback((_event) => {
    setDate("");
    setTime("");
  }, []);

  const handleDateChange = useCallback((value) => setDate(value), []);
  const handleTimeChange = useCallback((value) => setTime(value), []);
  return (
    <Layout>
      <Layout.Section oneHalf>
        <Card title="Date">
          <Form onSubmit={handleSubmitDate}>
            <TextField
              value={date}
              onChange={handleDateChange}
              type="date"
            />
          </Form>
        </Card>
      </Layout.Section>
      <Layout.Section oneHalf>
        <Card title ="Time">
        <Form onSubmit={handleSubmitTime}>
          <TextField
            value={time}
            onChange={handleTimeChange}
            type="time"
          />
        </Form>
        </Card>
      </Layout.Section>

    </Layout>
  );
}