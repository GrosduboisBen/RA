import React, { useCallback, useState } from "react";
import {
  Layout,
  Button,
  TextField,
  Form,
  FormLayout
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
    <Form onSubmit={handleSubmitDate}>
        <TextField
          value={date}
          onChange={handleDateChange}
          label="Date"
          type="date"
        />
         <Button submit>Submit</Button>
        </Form></Layout.Section>
        <Layout.Section oneHalf>
        <Form onSubmit={handleSubmitTime}>
        <TextField 
          value={time}
          onChange={handleTimeChange}
          label="Time"
          type="time"
        />

        <Button submit>Submit</Button>
    </Form>
    </Layout.Section>
    
    </Layout>
  );
}